<?php
defined('TYPO3_MODE') || die('Access denied.');

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


call_user_func(
    function ($extKey) {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Cyz.CyzAddress',
            'Address',
            [
                'Address' => 'list, show',
            ]
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('
        <INCLUDE_TYPOSCRIPT: source="FILE:EXT:cyz_address/Configuration/TSconfig/NewContentElementWizard.ts">
        <INCLUDE_TYPOSCRIPT: source="FILE:EXT:cyz_address/Configuration/TSconfig/Page/Layouts.ts">');

        if (TYPO3_MODE === 'BE') {
            $icons = ['ext-new-wizard-icon' => 'ce_wiz.svg',];

            /** @var \TYPO3\CMS\Core\Imaging\IconRegistry $iconRegistry */
            $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

            foreach ($icons as $identifier => $path) {
                $iconRegistry->registerIcon($identifier,
                    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
                    ['source' => 'EXT:cyz_address/Resources/Public/Icons/' . $path]);
            }
        }
    },
    $_EXTKEY
);
