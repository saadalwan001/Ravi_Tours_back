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
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->decimal('adult_single_price', 10, 2)->nullable()->after('excluded_items');
            $table->decimal('child_single_price', 10, 2)->nullable()->after('adult_single_price');
            $table->json('adult_group_pricing')->nullable()->after('child_single_price');
            $table->json('child_group_pricing')->nullable()->after('adult_group_pricing');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->dropColumn(['adult_single_price', 'child_single_price', 'adult_group_pricing', 'child_group_pricing']);
        });
    }
};