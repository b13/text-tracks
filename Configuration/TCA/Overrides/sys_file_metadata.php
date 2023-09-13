<?php

defined('TYPO3') || die();

if ((new \TYPO3\CMS\Core\Information\Typo3Version())->getMajorVersion() > 11) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'sys_file_metadata',
        [
            'tracks' => [
                'label' => 'LLL:EXT:text_tracks/Resources/Private/Language/locallang.xlf:sys_file_metadata.tracks',
                'l10n_mode' => 'exclude',
                'displayCond' => 'USER:' . \B13\TextTracks\TextTrackDisplayCondition::class . '->displayTracksField',
                'config' => [
                    'type' => 'file',
                    'allowed' => ['vtt'],
                ],
            ],
        ]
    );
} else {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'sys_file_metadata',
        [
            'tracks' => [
                'label' => 'LLL:EXT:text_tracks/Resources/Private/Language/locallang.xlf:sys_file_metadata.tracks',
                'l10n_mode' => 'exclude',
                'displayCond' => 'USER:' . \B13\TextTracks\TextTrackDisplayCondition::class . '->displayTracksField',
                'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                    'tracks',
                    [],
                    '',
                    'vtt',
                )
            ],
        ]
    );
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'sys_file_metadata',
    '25',
    '--linebreak--, tracks',
);
