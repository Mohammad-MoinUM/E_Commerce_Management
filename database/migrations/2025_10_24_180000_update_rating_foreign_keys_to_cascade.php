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
        // Ensure product_rate rows are deleted when a product is deleted
        Schema::table('product_rate', function (Blueprint $table) {
            // Drop existing FK and re-add with cascade
            try {
                $table->dropForeign(['product_id']);
            } catch (\Throwable $e) {
                // If the foreign key was already dropped or named differently, ignore
            }
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
        });

        // Ensure vendor_rate rows are deleted when a vendor is deleted
        Schema::table('vendor_rate', function (Blueprint $table) {
            try {
                $table->dropForeign(['vendor_id']);
            } catch (\Throwable $e) {
                // If the foreign key was already dropped or named differently, ignore
            }
            $table->foreign('vendor_id')->references('id')->on('vendor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_rate', function (Blueprint $table) {
            try {
                $table->dropForeign(['product_id']);
            } catch (\Throwable $e) {
                // ignore
            }
            $table->foreign('product_id')->references('id')->on('product')->onDelete('restrict');
        });

        Schema::table('vendor_rate', function (Blueprint $table) {
            try {
                $table->dropForeign(['vendor_id']);
            } catch (\Throwable $e) {
                // ignore
            }
            $table->foreign('vendor_id')->references('id')->on('vendor')->onDelete('restrict');
        });
    }
};