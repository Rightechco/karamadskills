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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('receiver_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('parent_id')->nullable()->constrained('tickets')->onUpdate('cascade')->onDelete('set null');
            $table->enum('status',\Modules\Ticket\Models\Ticket::$statuses)->default(\Modules\Ticket\Models\Ticket::OPEN);
            $table->text('name')->nullable();
            $table->text('text');
            $table->boolean('unSeenSender')->default(0)->index();
            $table->boolean('unSeenReceiver')->default(1)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
