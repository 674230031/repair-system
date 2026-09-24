<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repair_requests', function (Blueprint $table) {
            $table->id();
            $table->string('requester_name', 100);
            $table->string('title');
            $table->string('category', 100);
            $table->string('location');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('status')->default('pending');
            $table->text('repair_result')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repair_requests');
    }
};
