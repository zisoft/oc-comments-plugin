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
            'description' => 'Zeigt existierende Kommentare und ein Formular für neue Kommentare',
            'header' => 'Hinterlasse einen Kommentar',
            'name' => 'Name',
            'email' => 'Email',
            'text' => 'Text',
            'send' => 'Kommentar abschicken'
        ]
    ]
];
