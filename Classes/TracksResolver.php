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

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Resource\FileRepository;

class TracksResolver
{
    protected FileRepository $fileRepository;

    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function getTracksToRender(File $file): array
    {
        $tracks = [];
        if ($file->getProperty('tracks')) {
            $foundFiles = $this->fileRepository->findByRelation(
                'sys_file_metadata',
                'tracks',
                $file->getMetaData()['uid']
            );
            foreach ($foundFiles as $trackFile) {
                if (!$this->canRenderTrack($trackFile)) {
                    continue;
                }
                $tracks[] = $trackFile;
            }
        }
        return $tracks;
    }

    protected function canRenderTrack(FileInterface $fileObject): bool
    {
        $publicUrl = (string)$fileObject->getPublicUrl();
        if (empty($publicUrl)) {
            return false;
        }
        $trackLanguage = $fileObject->getProperty('track_language') ?: '';
        $trackType = $fileObject->getProperty('track_type') ?: 'subtitles';
        if ($trackType === 'subtitles' && empty($trackLanguage)) {
            return false;
        }
        return true;
    }
}
