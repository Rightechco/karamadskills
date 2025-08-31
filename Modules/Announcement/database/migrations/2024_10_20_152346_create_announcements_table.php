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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('ostan_id')->nullable()->constrained('ostan')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('shahrestan_id')->nullable()->references('id')->on('shahrestan')->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('status',\Modules\Announcement\Models\Announcement::$statuses)->default(\Modules\Announcement\Models\Announcement::STATUS_WAIT);
            $table->text('des')->nullable();
            $table->integer('wage')->nullable();
            $table->string('edu')->nullable();
            $table->string('background')->nullable();
            $table->string('military')->nullable();
            $table->enum('gender',\Modules\Announcement\Models\Announcement::$genders)->nullable();
            $table->json('jobType')->nullable();
            $table->json('location')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
