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
        Schema::create('bakhsh', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('ostan_id')->references('id')->on('ostan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('shahrestan_id')->references('id')->on('shahrestan')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('amar_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bakhsh');
    }
};
