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
        Schema::create('solider_status_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solider_id')->constrained('soliders')->cascadeOnDelete();
            $table->date('go_date');
            $table->date('return_date')->nullable();
            $table->string('status');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('solider_status_histories');
    }
};
