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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid('_id')->unique();
            $table->enum('specialCodeDescription', allowed: ['P.SİLİNDİR', 'D.PNÖMATİK', 'VAKUM', 'D.HİDROLİK', 'H.ÜNİTE', 'H.POMPA', 'H.HORTUM', 'KATALOG', 'NONE'])->default('NONE');
            $table->enum('type', ['YM', 'TM', 'SK', 'HM', 'MM', 'OTHER'])->default('OTHER');
            $table->string('specialCode')->nullable();
            $table->string('code')->unique();
            $table->string('description');
            $table->string('groupCode')->nullable();
            $table->enum('mainUnit', ['AD', 'MT', 'KG'])->default('AD');
            $table->enum('status', ['ACTIVE', 'PASSIVE'])->default('ACTIVE');
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
        Schema::dropIfExists('products');
    }
};
