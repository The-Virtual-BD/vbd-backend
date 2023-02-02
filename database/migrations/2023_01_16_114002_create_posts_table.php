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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained("users")->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('category_id')->constrained("categories")->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->string('cover')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('description');
            $table->integer('status')->default(1)->comment('1 => pending, 2 => published');
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
        Schema::dropIfExists('posts');
    }
};
