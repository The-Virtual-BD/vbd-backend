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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('client_name')->nullable();
            $table->foreignId('user_id')->nullable()->constrained("users")->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('service_id')->constrained("services")->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('starting_date')->nullable();
            $table->timestamp('ending_date')->nullable();
            $table->string('value')->nullable();
            $table->string('value_paid')->nullable();
            $table->string('value_payable')->nullable();
            $table->string('documents')->nullable();
            $table->string('cover')->nullable();
            $table->longText('description');
            $table->longText('short_description');
            $table->integer('status')->default(1)->comment('1 => pending, 2 => confirmed, 2 => cancelled');
            $table->integer('protfolio')->default(1)->comment('1 => no, 2 => yes');
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
        Schema::dropIfExists('projects');
    }
};
