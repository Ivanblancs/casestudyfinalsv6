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
        if (!Schema::hasTable('carts')) {
            Schema::create('carts', function (Blueprint $table) {
                $table->id(); // Primary key for the cart
                $table->foreignId('user_id'); // Foreign key for the user
                $table->unsignedInteger('product_id'); // Ensure the foreign key references product_id correctly
                $table->string('product_name');
                $table->text('product_description');
                $table->decimal('price', 10, 2); // Price of the product
                $table->integer('quantity')->default(1); // Default quantity
                $table->integer('selected')->default(1); // Boolean to indicate if the item is selected for checkout
                $table->timestamps();
            });
        }

        // Add foreign key constraints after the table creation
        Schema::table('carts', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
