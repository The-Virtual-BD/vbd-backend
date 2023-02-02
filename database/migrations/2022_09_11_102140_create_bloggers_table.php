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
        Schema::create('bloggers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained("users")->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->text('subject');
            $table->string('expertise');
            $table->text('description');
            $table->integer('status')->default(1)->comment('1 => pending, 2 => confirmed, 3 => cancelled');
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
        Schema::dropIfExists('bloggers');
    }
};
