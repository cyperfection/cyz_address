<?php

namespace Cyz\CyzAddress\Hooks;

use TYPO3\CMS\Core\Utility\StringUtility;

class ItemsProcFunc
{
    public function layouts(array &$config)
    {
        $pageId = 0;

        if (!StringUtility::beginsWith($config['row']['uid'], 'NEW')) {
            $pageId = $config['flexParentDatabaseRow']['pid'];
        }


        if ($pageId > 0) {
            $pageTsConfig = \TYPO3\CMS\Backend\Utility\BackendUtility::getPagesTSconfig($pageId);

            if (isset($pageTsConfig['tx_cyzaddress.']['layouts.']) && is_array($pageTsConfig['tx_cyzaddress.']['layouts.'])) {

                foreach ($pageTsConfig['tx_cyzaddress.']['layouts.'] as $key => $title) {
                    array_push($config['items'], [$title, $key]);
                }
            }
        }
    }
}