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
        Schema::create('resume_shahrestan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resume_id')->nullable()->references('id')->on('resumes')->onDelete('cascade');
            $table->foreignId('shahrestan_id')->nullable()->references('id')->on('shahrestan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume_shahrestan');
    }
};
