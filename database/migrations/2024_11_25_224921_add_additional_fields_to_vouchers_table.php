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
        Schema::table('vouchers', function (Blueprint $table) {
            if (!Schema::hasColumn('vouchers', 'serie')) {
                $table->string('serie')->nullable();
            }
            if (!Schema::hasColumn('vouchers', 'numero')) {
                $table->string('numero')->nullable();
            }
            if (!Schema::hasColumn('vouchers', 'tipo_comprobante')) {
                $table->string('tipo_comprobante')->nullable();
            }
            if (!Schema::hasColumn('vouchers', 'moneda')) {
                $table->string('moneda')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->dropColumn(['serie', 'numero', 'tipo_comprobante', 'moneda']);
        });
    }
};