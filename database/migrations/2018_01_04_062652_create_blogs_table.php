<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('blog_id');
            $table->integer("cat_id")->unsigned()->index();
            $table->integer("id")->unsigned()->index();
            $table->string("blog_title")->unique();
            $table->longText("blog_content");
            $table->string("blog_image_poster");
            $table->string("blog_pdf_file_embed")->nullable();
            $table->string("blog_video_embed")->nullable();
            $table->longText("blog_meta_desc");
            $table->string("blog_meta_key");
            $table->integer("blog_view_count")->default(0);
            $table->integer("blog_help_count")->default(0);
            $table->integer("blog_shared_count")->default(0);
            $table->integer("blog_file_download_count")->default(0);
            $table->enum("blog_isdraft", ["0", "1"])->default("0");
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
        Schema::dropIfExists('blogs');
    }
}
