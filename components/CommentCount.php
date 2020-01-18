<?php namespace Zisoft\Comments\Components;

use Cms\Classes\ComponentBase;
use Zisoft\Comments\Models\Comment;
use Lang;

class CommentCount extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => Lang::get('zisoft.comments::lang.components.commentcount.component_name'),
            'description' => Lang::get('zisoft.comments::lang.components.commentcount.description')
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $this->addCss('assets/css/commentcount.css');
    }

    public function value()
    {
        return Comment::where('page_id', $this->page->id)
            ->where('is_pending', false)
            ->count();
    }
}
