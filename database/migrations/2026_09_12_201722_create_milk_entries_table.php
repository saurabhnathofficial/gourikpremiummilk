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
        Schema::create('milk_entries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('farmer_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('entry_date');

            $table->decimal('cow_morning', 8, 2)->default(0);

            $table->decimal('cow_evening', 8, 2)->default(0);

            $table->decimal('buffalo_morning', 8, 2)->default(0);

            $table->decimal('buffalo_evening', 8, 2)->default(0);

            $table->timestamps();

            $table->unique(['farmer_id', 'entry_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milk_entries');
    }
};
