<?php

/*
 * This file is part of the "Cyz_Address" Extension for TYPO3 CMS.
 * (c) 2017 Luca Kredel <luca.kredel@cyperfection.de>, cyperfection gmbh
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, version 3.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */


/*
 * Override image '0' type in order to use the imageoverlayPalette - somehow tt_address does not have all fields
 * of imageoverlayPalette in it's backend form although imageoverlayPalette is set in TCA...
 *
 * The purpose of this is to enable the crop function for images
 */

$tempCols = [
    '0' => [
        'showitem' => '
            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
            --palette--;;filePalette'
    ],
    \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
        'showitem' => '
            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
            --palette--;;filePalette'
    ],
    \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
        'showitem' => '
            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
            --palette--;;filePalette'
    ],
    \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
        'showitem' => '
            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
            --palette--;;filePalette'
    ],
    \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
        'showitem' => '
            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
            --palette--;;filePalette'
    ],
    \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
        'showitem' => '
            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
            --palette--;;filePalette'
    ]
];

$GLOBALS['TCA']['tt_address']['columns']['image']['config']['overrideChildTca']['types'] = $tempCols;



