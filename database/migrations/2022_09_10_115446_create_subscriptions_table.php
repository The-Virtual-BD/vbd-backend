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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained("users")->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('service_id')->constrained("services")->onUpdate('cascade')->onDelete('cascade');
            $table->text('subject');
            $table->longText('description');
            $table->string('attachment')->nullable();
            $table->timestamp('schedule');
            $table->integer('status')->default(1)->comment('1 => pending, 2 => scheduling, 3 => confirmed');
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
        Schema::dropIfExists('subscriptions');
    }
};
