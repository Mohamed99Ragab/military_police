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
        Schema::create('soliders', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('military_number'); 
            $table->string('phone_number');
            $table->string('address');
            $table->string('photo')->nullable();
            $table->foreignId('degree_id')->nullable()->constrained('degrees')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
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
        Schema::dropIfExists('soliders');
    }
};
