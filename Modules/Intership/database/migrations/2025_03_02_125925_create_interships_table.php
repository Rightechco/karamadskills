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
        Schema::create('interships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('announcement_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('university_id')->nullable()->constrained('universities')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->enum('status',\Modules\Intership\Models\Intership::$statuses)->default(\Modules\Intership\Models\Intership::STATUS_WAIT);
            $table->string('rejectedText')->nullable();
            $table->text('introduction')->nullable();
            $table->text('report')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interships');
    }
};
