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
        return [];
    }

    public function onRun()
    {
        $this->addCss('assets/css/comments.css');
        $this->page['require_approval'] = Settings::get('require_approval', true);
    }

    public function onPostComment()
    {
        // post parameters
        $name      = post('comment-name');
        $email     = post('comment-email');
        $text      = post('comment-text');
        $parent_id = post('comment-reply-to');

        $parent_id = (int) $parent_id;
        if ($parent_id == 0) {
            $parent_id = null;
        }

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

        $require_approval = Settings::get('require_approval', true);
     
        // save
        $comment = new Comment;
        $comment->parent_id = $parent_id;
        $comment->dt = time();
        $comment->page_id = $this->page->id;
        $comment->is_pending = $require_approval;
        $comment->name = $name;
        $comment->email = $email;
        $comment->text = $text;
        $comment->save();

        if ($require_approval) {
            // send email to administrator
            $recipient = Settings::get('approval_email');

            if ($recipient != '') {
                $mail_vars = [
                    'comment_id' => $comment->id,
                    'name' => $name,
                    'email' => $email,
                    'text' => $text,
                    'page' => $this->page->title,
                    'url' => $this->page->url,
                    'approve_url' => Backend::url("zisoft/comments/comments/approve?id=$comment->id&url=" . $this->page->url),
                    'delete_url' => Backend::url("zisoft/comments/comments/delete?id=$comment->id&url=" . $this->page->url)
                ];
                
                Mail::sendTo($recipient, 'zisoft.comments::mail.new_comment', $mail_vars);
            }
        }
    }

    public function commentslist()
    {
        return $this->processNode(null);
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
                'gravatar' => 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($comment->email)))
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
