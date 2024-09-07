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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('to_user_id');//->nullable(false)->change();
            $table->integer('price');
            $table->string('content');
            $table->timestamps();

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users'); //->onDelete('cascade');
            //$table->foreign('to_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
            //$table->unsignedBigInteger('to_user_id')->nullable(false)->change();
    }
};
