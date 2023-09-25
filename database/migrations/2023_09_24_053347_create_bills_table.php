<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name', 255);
            $table->string('customer_address', 255);
            $table->string('customer_phone', 255);
            $table->string('customer_email', 255)->nullable();
            $table->string('payment_method', 255);
            $table->decimal('payment_amount', 12, 2);
            $table->string('order_note', 255);
            $table->string('status', 255);
            $table->timestamp('last_modified_date')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->bigInteger('last_modified_by')->unsigned();
            $table->foreign('last_modified_by')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};