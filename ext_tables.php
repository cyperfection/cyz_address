<?php
defined('TYPO3_MODE') || die('Access denied.');

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
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:cyz_address/Configuration/PageTS/NewContentElementWizard.ts">');

        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,pages,recursive';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:cyz_address/Configuration/FlexForms/' . $pluginSignature . '.xml');
    },
    $_EXTKEY
);
