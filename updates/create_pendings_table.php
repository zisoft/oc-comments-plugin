<?php namespace Zisoft\Comments\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePendingsTable extends Migration
{
    public function up()
    {
        Schema::create('zisoft_comments_pendings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('zisoft_comments_pendings');
    }
}
