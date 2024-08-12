<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Constants\PaymentStatus;
use App\Constants\PaymentGateway;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->nullable()->unique();
            $table->string('description', 100)->nullable();
            $table->float('amount');
            $table->foreignId('currency_id')->constrained();
            $table->enum('status', PaymentStatus::toArray());
            $table->enum('gateway', PaymentGateway::toArray());
            $table->unsignedInteger('process_identifier')->nullable();
            $table->dateTime('expiration')->nullable();
            $table->json('fields_data')->nullable();
            $table->foreignId('site_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
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
