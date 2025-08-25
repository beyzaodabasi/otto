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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('_id')->unique();
            $table->string('email')->unique();
            $table->string('name');
            $table->string('userName')->unique();
            $table->string('password');
            $table->enum('userType', ['MEMBER', 'ADMIN']);
            // Admin, Yönetici, Muhasebe, Satış, İmalat, Montaj, Kargo
            $table->enum('unit', ['ADMIN', 'MANAGER', 'ACCOUNTING', 'SALES', 'MANUFACTURING', 'ASSEMBLY', 'CARGO']);
            $table->enum('status', ['ACTIVE', 'PASSIVE'])->default('ACTIVE');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
