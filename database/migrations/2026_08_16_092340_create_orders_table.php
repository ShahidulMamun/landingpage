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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_group_id', 36)->nullable();
            $table->unsignedBigInteger('product_id');
            $table->string('product_name');
            $table->unsignedInteger('unit_price');
            $table->unsignedInteger('quantity')->default(1);
            $table->unsignedInteger('total_price');
            $table->string('customer_name');
            $table->string('phone', 20);
            $table->text('address');
            $table->enum('payment_method', ['cod', 'bkash'])->default('cod');
            $table->enum('payment_status', ['unpaid', 'paid', 'refunded'])->default('unpaid');
            $table->enum('status', ['pending', 'confirmed', 'shipped', 'delivered', 'cancelled'])->default('pending');
            $table->enum('delivery_area', ['dhaka', 'outside_dhaka'])->nullable()->after('address');
            $table->unsignedInteger('delivery_charge')->default(0)->after('delivery_area');
            $table->timestamps();
            $table->index('phone');
            $table->index('status');
            $table->index('order_group_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
      
    }
};
