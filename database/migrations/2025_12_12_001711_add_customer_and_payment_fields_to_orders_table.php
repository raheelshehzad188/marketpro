<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('customer_type')->nullable()->after('user_id');
            $table->string('personal_number')->nullable()->after('customer_type');
            $table->string('vat_number')->nullable()->after('personal_number');
            $table->string('order_reference')->nullable()->after('code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['customer_type', 'personal_number', 'vat_number', 'order_reference']);
        });
    }
};
