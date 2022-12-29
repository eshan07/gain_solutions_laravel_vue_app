<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->string('name');
            $table->string('bn_name')->nullable();
            $table->string('feature_image');
            $table->text('description')->nullable();
            $table->text('specification')->nullable();
            $table->text('delivery_info')->nullable();
            $table->text('faqs')->nullable();
            $table->text('short_note')->nullable();
            $table->unsignedBigInteger('current_stock')->nullable();
            $table->unsignedDouble('price');
            $table->string('unit');
            $table->string('slug')->unique();
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('products');
    }
};
