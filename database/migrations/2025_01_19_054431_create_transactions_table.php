<?php

use App\Models\Account;
use App\Models\Address;
use App\Models\Bank;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Address::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Account::class)->nullable()->constrained()->nullOnDelete();
            $table->string('transaction_id')->unique();
            $table->text('payment_proof');
            $table->enum('status', array_keys(Transaction::STATUS))->default(array_keys(Transaction::STATUS)[0]);
            $table->integer('subtotal')->default(0);
            $table->integer('shipping')->default(20_000);
            $table->integer('total')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
