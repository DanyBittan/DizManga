<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('comics', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('img');
            $table->string('publisher');
            $table->string('ISBN')->unique();
            $table->date('launch_date')->nullable;
            $table->string('type');
            $table->string('genres');
            $table->decimal('price', $precision = 10, $scale = 2);
            $table->text('sinopsis');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comics');
    }
};
