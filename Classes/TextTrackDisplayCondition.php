<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace B13\TextTracks;

use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Resource\Rendering\VideoTagRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class TextTrackDisplayCondition
{
    protected array $possibleMimeTypes = ['video/mp4', 'video/webm', 'video/ogg', 'video/x-m4v', 'application/ogg'];

    public function displayTracksField(array $data): bool
    {
        $record = $data['record'];
        $fileUid = 0;
        if (isset($record['file'])) {
            $fileUid = (int)($record['file'][0] ?? 0);
        }

        if ($fileUid === 0) {
            return false;
        }

        $fileRepository = GeneralUtility::makeInstance(FileRepository::class);
        $file = $fileRepository->findByUid($fileUid);
        return in_array($file->getMimeType(), $this->possibleMimeTypes, true);
    }
}
