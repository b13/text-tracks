<?php

defined('TYPO3') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'sys_file_reference',
    [
        'track_label' => [
            'displayCond' => [
                'AND' => [
                    'FIELD:fieldname:=:tracks',
                    'FIELD:tablenames:=:sys_file_metadata',
                ],
            ],
            'exclude' => true,
            'label' => 'LLL:EXT:text_tracks/Resources/Private/Language/locallang.xlf:sys_file_reference.track_label',
            'description' => 'LLL:EXT:text_tracks/Resources/Private/Language/locallang.xlf:sys_file_reference.track_label.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
            ],
        ],
        'track_language' => [
            'displayCond' => [
                'AND' => [
                    'FIELD:fieldname:=:tracks',
                    'FIELD:tablenames:=:sys_file_metadata',
                ],
            ],
            'exclude' => true,
            'label' => 'LLL:EXT:text_tracks/Resources/Private/Language/locallang.xlf:sys_file_reference.track_language',
            'description' => 'LLL:EXT:text_tracks/Resources/Private/Language/locallang.xlf:sys_file_reference.track_language.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 30,
            ],
        ],
        'track_type' => [
            'displayCond' => [
                'AND' => [
                    'FIELD:fieldname:=:tracks',
                    'FIELD:tablenames:=:sys_file_metadata',
                ],
            ],
            'exclude' => true,
            'label' => 'LLL:EXT:text_tracks/Resources/Private/Language/locallang.xlf:sys_file_reference.track_type',
            'description' => 'LLL:EXT:text_tracks/Resources/Private/Language/locallang.xlf:sys_file_reference.track_type.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label'=> 'LLL:EXT:text_tracks/Resources/Private/Language/locallang.xlf:sys_file_reference.track_type.captions',
                        'value' => 'captions',
                    ],
                    [
                        'label'=> 'LLL:EXT:text_tracks/Resources/Private/Language/locallang.xlf:sys_file_reference.track_type.chapters',
                        'value' => 'chapters',
                    ],
                    [
                        'label'=> 'LLL:EXT:text_tracks/Resources/Private/Language/locallang.xlf:sys_file_reference.track_type.descriptions',
                        'value' => 'descriptions',
                    ],
                    [
                        'label'=> 'LLL:EXT:text_tracks/Resources/Private/Language/locallang.xlf:sys_file_reference.track_type.metadata',
                        'value' => 'metadata',
                    ],
                    [
                        'label'=> 'LLL:EXT:text_tracks/Resources/Private/Language/locallang.xlf:sys_file_reference.track_type.subtitles',
                        'value' => 'subtitles',
                    ],
                ],
                'default' => 'subtitles',
            ],
        ],
        'track_default' => [
            'displayCond' => [
                'AND' => [
                    'FIELD:fieldname:=:tracks',
                    'FIELD:tablenames:=:sys_file_metadata',
                ],
            ],
            'exclude' => true,
            'label' => 'LLL:EXT:text_tracks/Resources/Private/Language/locallang.xlf:sys_file_reference.track_default',
            'description' => 'LLL:EXT:text_tracks/Resources/Private/Language/locallang.xlf:sys_file_reference.track_default.description',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
    ]
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'sys_file_reference',
    'basicoverlayPalette',
    '--linebreak--,track_default,--linebreak--,track_label,track_language,track_type'
);
