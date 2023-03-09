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
        Schema::create('sub_chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained("users")->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('subscription_id')->constrained("subscriptions")->onUpdate('cascade')->onDelete('cascade');
            $table->longText('message');
            $table->string('attachment')->nullable();
            $table->tinyInteger('type')->default(1)->comment('1 => user, 2 => admin');
            $table->tinyInteger('status')->default(1)->comment('1 => unreaded, 2 => readed');
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
        Schema::dropIfExists('sub_chats');
    }
};
