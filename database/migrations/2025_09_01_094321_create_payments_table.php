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
        Schema::create('payments', function (Blueprint $table) {
                $table->id();
    
    // Use BIGINT to match bills.bill_number type
    $table->unsignedBigInteger('bill_number');
    
    $table->enum('type', ['payment', 'debit_note']);
    $table->decimal('amount', 12, 2);
    $table->date('payment_date');
    $table->timestamps();

    // Foreign key references bills.bill_number, not id
    $table->foreign('bill_number')
          ->references('bill_number')
          ->on('bills')
          ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
