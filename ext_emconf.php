<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Newsletter',
    'description' => 'Send any pages as Newsletter and provide statistics on opened emails and clicked links.',
    'category' => 'module',
    'version' => '4.0.0',
    'state' => 'stable',
    'uploadfolder' => 1,
    'author' => 'Mirko (developer: Ecodev)',
    'author_email' => 'support@mirko.in.ua',
    'author_company' => 'Mirko',
    'constraints' => [
        'depends' => [
            'php' => '5.6.0-0.0.0',
            'typo3' => '7.6.0-8.99.99',
            'scheduler' => '7.6.0-8.99.99',
        ],
    ],
];
