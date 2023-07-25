<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dictionary_authors', function (Blueprint $table) {
            $table->id();
            //make it a foreing ID and cascade on delete 
            $table->foreignId('author_id')->constrained('authors')->cascadeOnDelete();
            $table->foreignId('dictionary_id')->constrained('dictionaries')->cascadeOnDelete();
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
        Schema::dropIfExists('dictionary_authors');
    }
};
