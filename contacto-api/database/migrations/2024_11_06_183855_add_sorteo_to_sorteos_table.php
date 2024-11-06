<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSorteoToSorteosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sorteos', function (Blueprint $table) {
            $table->enum('sorteo', ['participa', 'concursocruz'])->after('id')->default('participa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sorteos', function (Blueprint $table) {
            //
        });
    }
}
