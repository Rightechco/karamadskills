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
        Schema::create('incentives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->unique()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('type_id')->nullable()->constrained('universities','id')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('ostan_id')->nullable()->constrained('universities','id')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('university_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->longText('incentive')->nullable();
            $table->integer('score')->nullable();
            $table->string('meeting')->nullable();
            $table->enum('status',\Modules\Incentive\Models\Incentive::$statuses)->default(\Modules\Incentive\Models\Incentive::STATUS_WAIT);
            $table->string('reject')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incentives');
    }
};
