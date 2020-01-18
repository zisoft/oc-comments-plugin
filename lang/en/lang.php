<?php

return [
    'plugin' => [
        'name' => 'Comments',
        'description' => 'Allow users to add comments to pages'
    ],
    'settings' => [
        'label' => 'Comments',
        'description' => 'Settings for the Comments plugin',
        'category' => 'Comments',
        'require_approval' => 'Wether new comments require approval by an adminstrator',
        'approval_email' => 'Approval email address'
    ],
    'components' => [
        'commentcount' => [
            'name' => 'Comment Count',
            'description' => 'Show the number of comments for a page',
            'text_before' => '',
            'text_after' => 'Comments'
        ],
        'comments' => [
            'name' => 'Comments',
            'description' => 'Show existing comments and a form to add a new comment',
            'header' => 'Leave a comment',
            'name' => 'Name',
            'email' => 'Email',
            'text' => 'Text',
            'send' => 'Send comment'
        ],
        'commentslist' => [
            'header' => 'Comments'
        ]
    ]
];
