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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('_id')->unique();
            $table->string('orderNumber')->unique();
            $table->string('customerCode');
            $table->json('productDetails');
            $table->string('productDescription')->nullable();
            $table->dateTime('orderDate');
            $table->dateTime('dueDate')->nullable();
            $table->string('personnelCode');
            $table->string('personnelName');
            $table->string('companyName');
            $table->string('description');
            // Shipped: Sevk Edildi, Cancelled: İptal Edildi, In Progress: İşlemde, Completed: Tamamlandı, Approved: Onaylandı
            $table->enum('orderStatus', ['SHIPPED', 'CANCELLED', 'IN_PROGRESS', 'COMPLETED', 'APPROVED'])->default('APPROVED');
            $table->dateTime('shippingDate')->nullable();
            $table->text('note')->nullable();
            $table->enum('status', ['ACTIVE', 'PASSIVE'])->default('ACTIVE');
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
};
