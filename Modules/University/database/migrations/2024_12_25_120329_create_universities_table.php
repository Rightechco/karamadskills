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
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('state',\Modules\University\Models\University::$states)->default(\Modules\University\Models\University::VAHED);
            $table->enum('type',\Modules\University\Models\University::$types)->default(\Modules\University\Models\University::SARASARI);
            $table->foreignId('parent_id')->nullable()->constrained('universities')->onUpdate('cascade')->onDelete('set null');
            $table->json('location')->nullable();
            $table->text('text')->nullable();
            $table->string('tell')->nullable();
            $table->string('website')->nullable();
            $table->json('gallery')->nullable();
            $table->json('logo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('universities');
    }
};
