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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->enum('status',\Modules\Visit\Models\Visit::$statuses)->default(\Modules\Visit\Models\Visit::STATUS_WAIT);
            $table->foreignId('university_id')->nullable()->constrained('universities')->onUpdate('cascade')->onDelete('set null');
            $table->text('image')->nullable();
            $table->text('videoLink')->nullable();
            $table->text('expert')->nullable();
            $table->text('des')->nullable();
            $table->string('tags')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
