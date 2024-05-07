<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('vendor');            
            $table->integer('cat_id');
            $table->integer('sub_cat_id')->nullable();
            $table->string('brand');
            $table->decimal('buying_price', 8, 2);
            $table->decimal('sale_price', 8, 2)->nullable();
            $table->integer('serial_no');
            $table->string('sales_type')->nullable();
            $table->integer('stock');
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->date('buying_date');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
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
}
