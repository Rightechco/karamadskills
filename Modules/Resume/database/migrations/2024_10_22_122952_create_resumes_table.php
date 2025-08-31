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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->string('skill');
            $table->timestamp('birthday');
            $table->enum('gender',\Modules\Resume\Models\Resume::$genders);
            $table->string('military')->nullable();
            $table->json('links')->nullable();
            $table->enum('martial',\Modules\Resume\Models\Resume::$martials);
            $table->text('aboutMe')->nullable();
            $table->json('career')->nullable();
            $table->json('jobType')->nullable();
            $table->enum('status',\Modules\Resume\Models\Resume::$status)->nullable();
            $table->json('edu')->nullable();
            $table->json('langs')->nullable();
            $table->string('wageDemand')->nullable();
            $table->json('projects')->nullable();
            $table->json('skills')->nullable();
            $table->json('courses')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
