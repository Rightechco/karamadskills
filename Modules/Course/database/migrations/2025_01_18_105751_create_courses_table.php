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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->enum('status',\Modules\Course\Models\Course::$statuses)->default(\Modules\Course\Models\Course::STATUS_WAIT);
            $table->morphs('courseable');
            $table->foreignId('teacher_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onUpdate('cascade')->onDelete('set null');
            $table->text('cover')->nullable();
            $table->text('note')->nullable();
            $table->text('expert')->nullable();
            $table->text('des')->nullable();
            $table->integer('price')->default(0);
            $table->tinyInteger('ownerPercent')->nullable();
            $table->tinyInteger('teacherPercent')->nullable();
            $table->integer('limit')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
