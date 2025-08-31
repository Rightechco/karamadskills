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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('status',\Modules\Company\Models\Company::$statuses)->default(\Modules\Company\Models\Company::STATUS_WAIT);
            $table->text('logo')->nullable();
            $table->text('cover')->nullable();
            $table->text('expert')->nullable();
            $table->text('des')->nullable();
            $table->string('population')->nullable();
            $table->string('foundation')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
