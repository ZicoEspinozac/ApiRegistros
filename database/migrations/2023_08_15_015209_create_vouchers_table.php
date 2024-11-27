<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('issuer_name');
            $table->string('issuer_document_type');
            $table->string('issuer_document_number');
            $table->string('receiver_name');
            $table->string('receiver_document_type');
            $table->string('receiver_document_number');
            $table->decimal('total_amount', 10, 2);
            $table->string('serie')->nullable();
            $table->string('numero')->nullable();
            $table->string('tipo_comprobante')->nullable();
            $table->string('moneda')->nullable();
            $table->text('xml_content');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}