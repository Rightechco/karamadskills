<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Wallet\Models\Withdraw;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
            $table->foreignId('bank_card_id')->references('id')->on('bank_cards')->onDelete('cascade');
            $table->string('amount');
            $table->string('transaction_id')->unique()->nullable();
            $table->enum('status', Withdraw::$status)->default(Withdraw::PENDING);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whitdraws');
    }
};
