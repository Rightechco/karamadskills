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
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->enum('status',\Modules\Post\Models\Post::$statuses)->default(\Modules\Post\Models\Post::STATUS_WAIT);
            $table->foreignId('university_id')->nullable()->constrained('universities')->onUpdate('cascade')->onDelete('set null');
            $table->text('image')->nullable();
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
        Schema::dropIfExists('posts');
    }
};
