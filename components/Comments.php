<?php namespace Zisoft\Comments\Components;

use Cms\Classes\ComponentBase;
use Zisoft\Comments\Models\Comment;

use Mail;
use Validator;
use ValidationException;


class Comments extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Comments',
            'description' => 'Show existing comments and a form to add a new comment'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun() {
        $this->page['all_comments'] = Comment::where('page_id', $this->page->id)
            ->where('is_pending', false)
            ->orderBy('dt')
            ->get();
    }

    public function onPostComment()
    {
        // post parameters
        $name    = post('comment-name');
        $email   = post('comment-email');
        $text    = post('comment-text');

        $validator = Validator::make(
            [
                'name'  => $name,
                'email' => $email,
                'text'  => $text
            ],
            [
                'name'  => 'required',
                'email' => 'required|email',
                'text'  => 'required|min:10'
            ]
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
     
        // save
        $comment = new Comment;
        $comment->dt = time();
        $comment->page_id = $this->page->id;
        $comment->name = $name;
        $comment->email = $email;
        $comment->text = $text;
        $comment->save();

        // send email to administrator
        $mail_vars = [
            'name' => $name,
            'email' => $email,
            'text' => $text,
            'page' => $this->page->title
        ];
        
        Mail::sendTo('mail@zisoft.de', 'zisoft.comments::mail.new_comment', $mail_vars);
    }

}
