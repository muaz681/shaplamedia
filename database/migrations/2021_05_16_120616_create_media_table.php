<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id('id');

            $table->string('link')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('potraitimage')->nullable();
            $table->string('landscapeimage')->nullable();
            $table->longText('media_type')->nullable();
            $table->string('ratings')->nullable();
            $table->date('release_date')->nullable();
            $table->text('extra_css')->nullable();
            $table->string('website')->nullable();
            $table->string('company')->nullable();
            $table->string('run_time')->nullable();
            $table->string('budget')->nullable();
            $table->string('box_office')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();


            $table->string('sound_mix')->nullable();
            $table->string('filming_location')->nullable();
            $table->string('country_origin')->nullable();
            $table->string('language')->nullable();



            // $table->string('movie_details')->nullable();
            // $table->string('movie_gallery')->nullable();
            // $table->string('author')->nullable();
            // $table->string('cover_artist')->nullable();
            // $table->longText('genre')->nullable();
            // $table->longText('publisher')->nullable();
            // $table->longText('published')->nullable();
            // $table->integer('no_of_books')->nullable();
            // $table->string('directed_by')->nullable();
            // $table->longText('screenplay_by')->nullable();
            // $table->string('story_by')->nullable();
            // $table->longText('starring')->nullable();
            // $table->string('music_by')->nullable();
            // $table->string('cinematography')->nullable();
            // $table->string('edited_by')->nullable();
            // $table->string('production')->nullable();
            // $table->string('distributed_by')->nullable();
            // Hasan Defaul coulmns 
            $table->string('remarks')->nullable();
            $table->integer('sort_by')->nullable();
            $table->enum('is_active', ['Yes', 'No'])->default('Yes');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('modified_by')->references('id')->on('users');
            $table->foreign('parent_id')->references('id')->on('media')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
