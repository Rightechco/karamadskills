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
        Schema::create('notifs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->string('name')->nullable();
            $table->foreignId('admin_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->enum('time',\Modules\Notif\Models\Notif::$time);
            $table->enum('status',\Modules\Notif\Models\Notif::$statuses)->default('notSent');
            $table->enum('type',\Modules\Notif\Models\Notif::$type);
            $table->string('subject')->nullable();
            $table->text('text');
            $table->timestamp('sented_at')->nullable();
            $table->text('res')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifs');
    }
};
