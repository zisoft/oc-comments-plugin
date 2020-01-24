<?php

return [
    'plugin' => [
        'name' => 'Kommentare',
        'description' => 'Erlaubt Besuchern, einen Kommentar zu hinterlassen'
    ],
    'settings' => [
        'label' => 'Kommentare',
        'description' => 'Einstellungen für die Kommentare',
        'category' => 'Kommentare',
        'require_approval' => 'Neue Kommentare müssen freigeschaltet werden',
        'approval_email' => 'Empfänger-Adresse für Freischaltungsmail'
    ],
    'components' => [
        'commentcount' => [
            'component_name' => 'Kommentarzähler',
            'description' => 'Zeigt die Anzahl der Kommentare für eine Seite',
            'text_before' => '',
            'text_after' => 'Kommentare'
        ],
        'comments' => [
            'component_name' => 'Kommentare',
            'description' => 'Zeigt existierende Kommentare und ein Formular für einen neuen Kommentar',
            'header' => 'Hinterlasse einen Kommentar',
            'name' => 'Name',
            'email' => 'Email',
            'email_not_publish' => '(wird nicht veröffentlicht)',
            'text' => 'Text',
            'send' => 'Kommentar abschicken',
            'comment_sent' => 'Vielen Dank! Dein Kommentar wartet auf Freigabe.'
        ],
        'commentslist' => [
            'header' => 'Kommentare'
        ]
    ],
    'backend' => [
        'lists' => [
            'list_title' => 'Kommentare verwalten',
            'new_comment' => 'Neuer Kommentar',
            'delete_selected' => 'Ausgewählte löschen',
            'delete_confirm' => 'Sollen die ausgewählten Kommentare wirklich gelöscht werden?',
            'approve_selected' => 'Ausgewählte freischalten',
            'approve_confirm' => 'Ausgewählte Kommentare freischalten?',
            'pending_only' => 'Nur freizuschaltende'
        ],
        'form' => [
            'name' => 'Kommentar',
            'create' => 'Kommentar erstellen',
            'update' => 'Kommentar ändern',
            'preview' => 'Kommentar-Vorschau'
        ]
    ],
    'model' => [
        'id' => 'ID',
        'parent_id' => 'Eltern ID',
        'page' => 'Seite',
        'pending' => 'Wartet auf Freigabe',
        'date' => 'Datum',
        'name' => 'Name',
        'email' => 'Email',
        'text' => 'Text'
    ]

];
