<?php namespace Zisoft\Comments\Components;

use Cms\Classes\ComponentBase;
use Zisoft\Comments\Models\Comment;
use Lang;

class CommentCount extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => Lang::get('zisoft.comments::lang.commentcount.component_name'),
            'description' => Lang::get('zisoft.comments::lang.commentcount.description')
        ];
    }

    public function defineProperties()
    {
        return [
            'containerClass' => [
                'title'             => 'css class for the container',
                'description'       => 'The css class for the container',
                'default'           => 'zsc-commentcount',
                'type'              => 'string'
            ],
            'textBefore' => [
                'title'             => 'Text before value',
                'description'       => 'The text before the value',
                'default'           => Lang::get('zisoft.comments::lang.commentcount.text_before'),
                'type'              => 'string'
            ],
            'textBeforeClass' => [
                'title'             => 'css class for the text before',
                'description'       => 'The css class for the text before the value',
                'default'           => 'zsc-commentcount-text-before',
                'type'              => 'string'
            ],
            'valueClass' => [
                'title'             => 'css class for the value',
                'description'       => 'The css class for the value',
                'default'           => 'zsc-commentcount-value',
                'type'              => 'string'
            ],
            'textAfter' => [
                'title'             => 'Text after value',
                'description'       => 'The text after the value',
                'default'           => Lang::get('zisoft.comments::lang.commentcount.text_after'),
                'type'              => 'string'
            ],
            'textAfterClass' => [
                'title'             => 'css class for the text after',
                'description'       => 'The css class for the text after the value',
                'default'           => 'zsc-commentcount-text-after',
                'type'              => 'string'
            ]
        ];    
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
