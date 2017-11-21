<?php

namespace Cyz\CyzAddress\Hooks;

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