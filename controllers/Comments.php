<?php namespace Zisoft\Comments\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use System\Classes\SettingsManager;
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
    public function onApprove() {
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
    public function approve() {
        if ($this->user->hasAccess('zisoft.comments.manage_comments')) {
            $id = post('id');
            $comment = Comment::find($id);
            $comment->is_pending = false;
            $comment->save();
        }
    }

     /**
      * Delete a single comment
      */
    public function delete() {
        if ($this->user->hasAccess('zisoft.comments.manage_comments')) {
            $id = post('id');
            $comment = Comment::find($id);
            $comment->delete();
        }
    }
}


