<?php namespace Zisoft\Comments\Controllers;

use BackendMenu;
use Request;
use Redirect;
use Backend\Classes\Controller;
use System\Classes\SettingsManager;
use Zisoft\Comments\Models\Settings;
use Zisoft\Comments\Models\Comment;

/**
 * Comments Back-end Controller
 */
class Comments extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['zisoft.comments.manage_comments'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Zisoft.Comments', 'comments', 'comments');
        SettingsManager::setContext('Zisoft.Comments', 'settings');
    }

    /**
     * Approve (set is_pending = 0) comments
     */
    public function onApprove()
    {
        $checked_ids = post('checked');
        
        foreach ($checked_ids as $id) {
            $comment = Comment::find($id);
            $comment->is_pending = false;
            $comment->save();
        }

        return $this->listRefresh();
     }

     /**
      * Approve a single comment
      */
    public function approve()
    {
        $id = \Request::input('id'); 
        $quickreply = \Request::input('quickreply'); 
        $url = "/";

        if ($this->user->hasAccess('zisoft.comments.manage_comments')) {
            $comment = Comment::find($id);
            $comment->is_pending = false;
            $url = $comment->url;
            $comment->save();
            
            if ($quickreply) {
                $reply_comment = new Comment;
                $reply_comment->parent_id = $id;
                $reply_comment->dt = time();
                $reply_comment->url = $url;
                $reply_comment->is_pending = false;
                $reply_comment->name = Settings::get('quickreply_name');
                $reply_comment->email = Settings::get('quickreply_email');
                $reply_comment->text = $quickreply;
                $reply_comment->save();
            }
        }
            
        return Redirect::to($url);
    }

     /**
      * Delete a single comment
      */
    public function delete() {
        $id = \Request::query('id'); 
        $url = "/";

        if ($this->user->hasAccess('zisoft.comments.manage_comments')) {
            $comment = Comment::find($id);
            $url = $comment->url;
            $comment->delete();
        }
        
        return Redirect::to($url);
    }
}
