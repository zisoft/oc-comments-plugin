<?php namespace Zisoft\Comments\Components;

use Cms\Classes\ComponentBase;

class CommentCount extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Comment Count',
            'description' => 'Show the number of existing comments for a page'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
}
