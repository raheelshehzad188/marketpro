<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMegaNavsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mega_navs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Link to Category
            $table->string('nav_type')->nullable(); // 'cross_gear' or 'cross_parts'
            $table->boolean('is_parent')->default(false); // Indicates if it’s a top-level item
            $table->foreignId('parent_id')->nullable()->constrained('mega_navs')->onDelete('set null'); // Self-referencing parent-child relationship
            $table->json('visibility')->nullable(); // JSON for shop visibility settings
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
        Schema::dropIfExists('mega_navs');
    }
}
