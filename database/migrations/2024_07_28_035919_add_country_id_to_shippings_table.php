<?php

// add_country_id_to_shippings_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryIdToShippingsTable extends Migration
{
    public function up()
    {
        Schema::table('shippings', function (Blueprint $table) {
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('shippings', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropColumn('country_id');
        });
    }
}
