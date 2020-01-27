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
            'email_not_publish' => '(will not be published)',
            'text' => 'Text',
            'send' => 'Send comment',
            'comment_sent' => 'Thank you! Your comment is awaiting approval'
        ],
        'commentslist' => [
            'header' => 'Comments'
        ]
    ],
    'backend' => [
        'lists' => [
            'list_title' => 'Manage comments',
            'new_comment' => 'New Comment',
            'delete_selected' => 'Delete selected',
            'delete_confirm' => 'Are you sure you want to delete the selected Comments?',
            'approve_selected' => 'Approve selected',
            'approve_confirm' => 'Are you sure you want to approve the selected Comments?',
            'pending_only' => 'Pending only'
        ],
        'form' => [
            'name' => 'Comment',
            'create' => 'Create comment',
            'update' => 'Update comment',
            'preview' => 'Preview comment'
        ],
        'permissions' => [
            'label' => 'Manage Comments'
        ]
    ],
    'model' => [
        'id' => 'ID',
        'parent_id' => 'Parent ID',
        'url' => 'URL',
        'pending' => 'Pending',
        'date' => 'Date',
        'name' => 'Name',
        'email' => 'Email',
        'text' => 'Text'
    ],
    'reportwidgets' => [
        'label' => 'Comments Statistics',
        'total' => 'Total',
        'table_comments' => 'Comments',
        'table_pending' => 'Pending',
        'maxrows' => 'Max. number of rows to display'
    ]

];
