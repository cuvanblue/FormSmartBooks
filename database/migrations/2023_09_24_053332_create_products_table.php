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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('brand', 255);
            $table->string('name', 255);
            $table->string('title', 255);
            $table->longText('specification')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->integer('quanity');
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
        Schema::dropIfExists('products');
    }
};