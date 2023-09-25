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
        Schema::create('bill_details', function (Blueprint $table) {
            $table->bigInteger('bill_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->integer('quanity');
            $table->timestamp('last_modified_date')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->bigInteger('last_modified_by')->unsigned();
            $table->foreign('last_modified_by')
                ->references('id')->on('users');
            $table->foreign('bill_id')
                ->references('id')->on('bills');
            $table->foreign('product_id')
                ->references('id')->on('products');
            $table->primary(['bill_id', 'product_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_details');
    }
};