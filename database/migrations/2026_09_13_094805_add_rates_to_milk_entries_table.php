<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('milk_entries', function (Blueprint $table) {

            $table->decimal('cow_morning_rate', 8, 2)
                ->nullable()
                ->after('cow_morning');

            $table->decimal('cow_evening_rate', 8, 2)
                ->nullable()
                ->after('cow_evening');

            $table->decimal('buffalo_morning_rate', 8, 2)
                ->nullable()
                ->after('buffalo_morning');

            $table->decimal('buffalo_evening_rate', 8, 2)
                ->nullable()
                ->after('buffalo_evening');
        });
    }

    public function down(): void
    {
        Schema::table('milk_entries', function (Blueprint $table) {

            $table->dropColumn([
                'cow_morning_rate',
                'cow_evening_rate',
                'buffalo_morning_rate',
                'buffalo_evening_rate',
            ]);
        });
    }
};