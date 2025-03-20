<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Sipariş id
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Ürün id
            // Status: Sipariş: ORDER, İmalat: MANUFACTURING, Montaj: ASSEMBLY, Muhasebe: ACCOUNTING, Sevk/Depo: SHIPPING, İptal: CANCELLED, Tamamlandı: COMPLETED
            $table->enum('status', ['ORDER', 'MANUFACTURING', 'ASSEMBLY', 'ACCOUNTING', 'SHIPPING', 'CANCELLED', 'COMPLETED'])->default('ORDER');
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product');
    }
};
