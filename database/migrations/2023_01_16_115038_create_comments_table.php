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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained("users")->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('post_id')->constrained("posts")->onUpdate('cascade')->onDelete('cascade');
            $table->integer('status')->default(1)->comment('1 => pending, 2 => published');
            $table->string('commenter_name');
            $table->string('commenter_email');
            $table->longText('body');
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
        Schema::dropIfExists('comments');
    }
};
