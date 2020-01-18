<?php namespace Zisoft\Comments\Components;

use Cms\Classes\ComponentBase;
use Zisoft\Comments\Models\Comment;
use Zisoft\Comments\Models\Settings;

use Lang;
use Mail;
use Validator;
use ValidationException;
use Backend;

class Comments extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => Lang::get('zisoft.comments::lang.components.comments.component_name'),
            'description' => Lang::get('zisoft.comments::lang.components.comments.description')
        ];
    }

    public function defineProperties()
    {
        return [
            'formClass' => [
                'title'             => 'css class for the form',
                'description'       => 'The css class for the form',
                'default'           => 'zsc-comment-form',
                'type'              => 'string'
            ],
            'commentListClass' => [
                'title'             => 'css class for the list container',
                'description'       => 'The css class for the comments list container',
                'default'           => 'zsc-comments-list',
                'type'              => 'string'
            ],
        ];
    }

    public function onRun()
    {
        $this->addCss('assets/css/comments.css');
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
                'text'  => 'required'
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

        if (Settings::get('require_approval', true)) {
            // send email to administrator
            $recipient = Settings::get('approval_email');

            $mail_vars = [
                'comment_id' => $comment->id,
                'name' => $name,
                'email' => $email,
                'text' => $text,
                'page' => $this->page->title,
                'approve_url' => Backend::url("zisoft/comments/comments/approve?id=$comment->id"),
                'delete_url' => Backend::url("zisoft/comments/comments/delete?id=$comment->id")
            ];
            
            Mail::sendTo($recipient, 'zisoft.comments::mail.new_comment', $mail_vars);
        }
    }

    public function commentslist()
    {
        $content = $this->processNode(null);

        return $content;
    }

    protected function processNode($parent_id)
    {
        $html = "";
        $first = true;

        $comments = Comment::where('page_id', $this->page->id)
                        ->where('is_pending', false)
                        ->where('parent_id', $parent_id)
                        ->orderBy('dt')
                        ->get();

        foreach ($comments as $comment) {
            if ($first) {
                $html .= $this->renderPartial('@_level_start.htm');
            }

            $html .= $this->renderPartial('@_item_start.htm');
            $html .= $this->renderPartial('@_comment.htm', [
                'id' => $comment->id,
                'dt' => $comment->dt,
                'name' => $comment->name,
                'text' => $comment->text,
                'gravatar' => 'https://www.gravatar.com/avatar/' . md5($comment->email)
            ]);
            $html .= $this->processNode($comment->id);
            $html .= $this->renderPartial('@_item_end.htm');
            $first = false;
        }

        if (!$first) {
            $html .= $this->renderPartial('@_level_end.htm');
        }

        return $html;
    }

}
