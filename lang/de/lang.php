<?php

return [
    'plugin' => [
        'name' => 'Kommentare',
        'description' => 'Erlaubt Besuchern, einen Kommentar zu hinterlassen'
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
