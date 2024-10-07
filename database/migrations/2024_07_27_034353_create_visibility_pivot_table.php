<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisibilityPivotTable extends Migration
{
    public function up()
    {
        Schema::create('visibility_pivot', function (Blueprint $table) {
            $table->id();
            $table->string('entity_type');
            $table->unsignedBigInteger('entity_id');
            $table->unsignedBigInteger('shop_id');
            $table->timestamps();

            $table->unique(['entity_type', 'entity_id', 'shop_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('visibility_pivot');
    }
}
