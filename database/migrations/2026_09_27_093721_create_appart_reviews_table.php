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
        Schema::create('appart_reviews', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('appartment_id')->unsigned();
            $table->foreign('appartment_id')->references('id')->on('appartments')->onDelete('cascade');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->longtext('comment');
            $table->double('grade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appart_reviews');
    }
};
