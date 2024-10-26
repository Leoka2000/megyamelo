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
        Schema::create('notes', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('university')->nullable();
            $table->string('photo')->nullable();
            $table->string('degree')->nullable();
            $table->string('area')->nullable();
            $table->text('description')->nullable();
            $table->string('cv')->nullable();
            $table->boolean('accept')->nullable();
            $table->string('linkedin')->default('');
            $table->string('referral')->nullable();
            $table->string('other_links')->default('');
            $table->boolean('is_published')->default(false);
            $table->integer('heart_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
