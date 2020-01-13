<?php namespace Zisoft\Comments\Updates;

// kann später weg
use Zisoft\Comments\Models\Comment;

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

        // Testdatensätze erzeugen
        for ($i = 1; $i <= 5; $i++) {
            $comment = new Comment;
            $comment->dt = time() - 3600 + $i*10;
            $comment->page_id = 'test';
            if ($i < 4) {
                $comment->is_pending = false;

                if ($i > 1) {
                    $comment->parent_id = $i - 1;
                }
            }
            $comment->name = 'Mario Zimmermann';
            $comment->email = 'mail@zisoft.de';
            $comment->text = "Dies ist Kommentar $i";
            $comment->save();
        }

    }

    public function down()
    {
        Schema::dropIfExists('zisoft_comments_comments');
    }
}
