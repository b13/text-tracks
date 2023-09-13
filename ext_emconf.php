<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Text Track Files for Videos',
    'description' => 'Add Text Track Files (VTT) to videos within TYPO3',
    'category' => 'fe',
    'version' => '0.1.0',
    'state' => 'stable',
    'clearcacheonload' => true,
    'author' => 'Benni Mack',
    'author_email' => 'typo3@b13.com',
    'author_company' => 'b13 GmbH',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-12.99.99',
        ],
    ],
];
