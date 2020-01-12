<?php

return [
    'plugin' => [
        'name' => 'Comments',
        'description' => 'Allow users to add comments to pages'
    ],
    'component_commentcount' => [
        'name' => 'Comment Count',
        'description' => 'Show the number of comments for a page',
        'text_before' => '',
        'text_after' => 'Comments'
    ],
    'component_comments' => [
        'name' => 'Comments',
        'description' => 'Show existing comments and a form to add a new comment',
        'header' => 'Leave a comment',
        'name' => 'Name',
        'email' => 'Email',
        'text' => 'Text',
        'send' => 'Send comment'
    ]
];
