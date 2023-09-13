<?php

declare(strict_types=1);

namespace B13\TextTracks;

/*
 * This file is part of TYPO3 CMS-based extension "text-tracks" by b13.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Resource\Rendering\VideoTagRenderer;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * VideoTagRenderer that adds VTT tracks to the video tag
 */
class VideoTagWithTextTracksRenderer extends VideoTagRenderer
{
    protected TracksResolver $tracksResolver;

    public function __construct(TracksResolver $tracksResolver)
    {
        $this->tracksResolver = $tracksResolver;
    }

    public function getPriority()
    {
        return 20;
    }

    public function render(FileInterface $file, $width, $height, array $options = [])
    {
        $result = parent::render($file, $width, $height, $options);
        return str_replace('</video>', $this->renderTracks($file) . '</video>', $result);
    }

    protected function renderTracks(FileInterface $file): string
    {
        $tracks = [];
        /** @var File $originalFile */
        $originalFile = $file;
        if ($file instanceof FileReference) {
            $originalFile = $file->getOriginalFile();
        }
        $trackFiles = $this->tracksResolver->getTracksToRender($originalFile);
        foreach ($trackFiles as $fileObject) {
            $trackAttributes = [
                'src' => (string)$fileObject->getPublicUrl(),
                'kind' => $fileObject->getProperty('track_type') ?: 'subtitles',
            ];
            $trackLanguage = $fileObject->getProperty('track_language') ?: '';
            if (!empty($trackLanguage)) {
                $trackAttributes['srclang'] = $trackLanguage;
            }
            $trackLabel = $fileObject->getProperty('track_label') ?: '';
            if (!empty($trackLabel)) {
                $trackAttributes['label'] = $trackLabel;
            }
            if ($fileObject->getProperty('track_default') ?: false) {
                $trackAttributes['default'] = 'default';
            }
            $tracks[] = '<track ' . GeneralUtility::implodeAttributes($trackAttributes, true) . ' />';
        }

        return implode('', $tracks);
    }
}
