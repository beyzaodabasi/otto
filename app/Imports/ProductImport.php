<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Type alanındaki veriyi parantez içindeki değere dönüştür
        preg_match('/\((.*?)\)/', trim($row['type'] ?? ''), $matches);
        $type = $matches[1] ?? 'OTHER'; // Eğer eşleşme yoksa "OTHER" olarak ata

        // Mevcut kayıt olup olmadığını kontrol et
        $existingProduct = Product::where('code', trim($row['code'] ?? ''))->first();

        return Product::updateOrCreate(
            ['code' => trim($row['code'] ?? '')], // Eğer code varsa günceller, yoksa ekler
            [
                '_id' => $existingProduct ? $existingProduct->_id : Str::uuid(), // Eğer kayıt varsa _id değiştirilmez
                'specialCodeDescription' => in_array(trim($row['specialcodedescription'] ?? ''), ['P.SİLİNDİR', 'D.PNÖMATİK', 'VAKUM', 'D.HİDROLİK', 'H.ÜNİTE', 'H.POMPA', 'H.HORTUM', 'KATALOG', 'NONE'])
                    ? trim($row['specialcodedescription'])
                    : 'NONE',
                'type' => in_array($type, ['YM', 'TM', 'SK', 'HM', 'MM', 'OTHER'])
                    ? $type
                    : 'OTHER',
                'specialCode' => !empty(trim($row['specialcode'] ?? '')) ? trim($row['specialcode']) : null,
                'description' => (string) trim($row['description'] ?? ''),
                'groupCode' => !empty(trim($row['groupcode'] ?? '')) ? trim($row['groupcode']) : null,
                'mainUnit' => (string) trim($row['mainunit'] ?? ''),
                'status' => in_array(trim($row['status'] ?? ''), ['ACTIVE', 'PASSIVE'])
                    ? trim($row['status'])
                    : 'ACTIVE',
            ]
        );
    }
}
