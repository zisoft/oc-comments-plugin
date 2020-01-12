<?php namespace Zisoft\Comments\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
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

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Zisoft.Comments', 'comments', 'comments');
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
        $id = post('id');
        $comment = Comment::find($id);
        $comment->is_pending = false;
        $comment->save();
    }
}


