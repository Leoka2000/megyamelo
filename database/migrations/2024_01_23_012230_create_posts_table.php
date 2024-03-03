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
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->string('image')->nullable();
            $table->string('author')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('apply_link')->nullable(); //precisa ser texto pq se nao vai aparecer um aviso de que a string eh mt comprida, caso o link for gigante
            $table->text('apply_email')->nullable();
            $table->boolean('accept_terms')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('payment')->nullable();
            $table->string('modality')->nullable();
            $table->integer('hours')->nullable();
            $table->string('full_or_part_time')->nullable();
         
          
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
