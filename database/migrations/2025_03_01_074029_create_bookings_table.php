<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->nullable()->constrained('posts')->onDelete('set null');
            $table->dateTime('date')->nullable();
            $table->time('time')->nullable();
            $table->string('name')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->string('amount')->nullable();
            $table->string('rate')->nullable();
            $table->string('method')->nullable();
            $table->string('method_address')->nullable();
            $table->string('account_number')->nullable();
            $table->string('type')->nullable();
            $table->string('work_type')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('status')->default('booked');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
