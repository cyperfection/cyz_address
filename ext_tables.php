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
        $pluginName = 'Address';
        $extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($extKey));
        $pluginSignature = $extensionName . '_' . strtolower($pluginName);

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Cyz.CyzAddress',
            $pluginName,
            'Cyz_Address - Address'
        );
        
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extKey, 'Configuration/TypoScript', 'Addresses');

        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,pages,recursive';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:cyz_address/Configuration/FlexForms/' . $pluginSignature . '.xml');
    },
    $_EXTKEY
);
