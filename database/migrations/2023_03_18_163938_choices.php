<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('choice', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('poll_vote_id');
            $table->foreign('poll_vote_id')->references('id')->on('poll_vote')->onDelete('cascade');
            $table->string('statement');
            $table->integer('votes')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('choices');
    }
};