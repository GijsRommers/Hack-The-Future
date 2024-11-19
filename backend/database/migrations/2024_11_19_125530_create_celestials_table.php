<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCelestialsTable extends Migration
{
    public function up(): void
    {
        Schema::create('celestials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->float('pitch')->nullable();
            $table->float('yaw')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('celestials');
    }
}
