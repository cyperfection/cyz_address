<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function ($extKey) {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Cyz.CyzAddress',
            'Address',
            [
                'Address' => 'list, show',
            ]
        );

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
