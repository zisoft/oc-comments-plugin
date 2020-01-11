<?php namespace Zisoft\Comments\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('zisoft_comments_comments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('parent_id')->nullable()->unsigned();
            $table->string('page_id')->index();
            $table->dateTime('dt');
            $table->boolean('is_pending')->default(true);
            $table->string('name', 64);
            $table->string('email', 64);
            $table->string('text', 2000);
        });
    }

    public function down()
    {
        Schema::dropIfExists('zisoft_comments_comments');
    }
}
