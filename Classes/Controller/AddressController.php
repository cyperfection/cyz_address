<?php

namespace Cyz\CyzAddress\Controller;

use \TYPO3\CMS\Core\Messaging\AbstractMessage;

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


class AddressController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \Cyz\CyzAddress\Domain\Repository\AddressRepository
     * @inject
     */
    protected $addressRepository = null;

    /**
     * list action
     */
    public function listAction()
    {
        switch ($this->settings['source']) {
            case 'single':
                $addresses = $this->settings['singleRecords'];
                $sorting = $this->settings['singleSorting'];

                if (!empty($addresses)) {
                    if($sorting === "flexform") {
                        $idList = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $addresses, true);
                        $i = 0;
                        foreach ($idList as $id) {
                            $address = $this->addressRepository->findByIdentifier($id);
                            $files = $this->addressRepository->getFileReferences($id);
                            if ($address) {
                                $addressRecords[$i]['address'] = $address;
                                $addressRecords[$i]['files'] = $files;
                                $i++;
                            }
                        }
                        $this->view->assign("addresses", $addressRecords);
                    } else {
                        $this->view->assign('addresses', $this->addressRepository->findInUidList(explode(',', $addresses)), $sorting);
                    }
                } else {
                    $this->addFlashMessage(
                        'No addresses selected',
                        'Error',
                        AbstractMessage::ERROR,
                        FALSE);
                }
                break;
            case 'categories':
                $selection = $this->settings['groupSelection'];
                $sorting = $this->settings['groupSorting'];
                $sortingColumn = $this->settings['groupSortingColumn'];

                if (!empty($selection)) {
                    $categoryAdresses = $this->addressRepository->findInCategories(
                        explode(',', $selection),
                        $this->settings['groupSelectionConstraint'],
                        $sorting,
                        $sortingColumn
                    );

                    $i = 0;
                    foreach ($categoryAdresses as $address) {
                        $files = $this->addressRepository->getFileReferences($address->getUid());
                        $addressRecords[$i]['address'] = $address;
                        $addressRecords[$i]['files'] = $files;
                        $i++;
                    }

                    $this->view->assign('addresses', $addressRecords);
                } else {
                    $this->addFlashMessage(
                        'No categories selected',
                        'Error',
                        AbstractMessage::ERROR,
                        FALSE);
                }
                break;
            case 'startingpoint':
                $pages = $this->settings['pages'];
                $sorting = $this->settings['groupSorting'];
                $sortingColumn = $this->settings['groupSortingColumn'];

                if (!empty($pages)) {
                    $addresses = $this->addressRepository->findInPidList(
                        explode(',', $pages),
                        $sorting,
                        $sortingColumn
                    );

                    $i = 0;
                    foreach ($addresses as $address) {
                        $files = $this->addressRepository->getFileReferences($address->getUid());
                        $addressRecords[$i]['address'] = $address;
                        $addressRecords[$i]['files'] = $files;
                        $i++;
                    }

                    $this->view->assign('addresses', $addressRecords);
                } else {
                    $this->addFlashMessage(
                        'No pages selected',
                        'Error',
                        AbstractMessage::ERROR,
                        FALSE);
                }
                break;
            default:
                $this->addFlashMessage(
                    'Invalid option: ' . $this->settings['source'],
                    'Error',
                    AbstractMessage::ERROR,
                    FALSE);
        }
        $cObj = $this->configurationManager->getContentObject();
        $this->view->assign('data', $cObj->data);
    }

    /**
     * show action
     *
     * @param \Cyz\CyzAddress\Domain\Model\Address $address
     */
    public function showAction(\Cyz\CyzAddress\Domain\Model\Address $address)
    {
        $this->view->assign('address', $address);

        $cObj = $this->configurationManager->getContentObject();
        $this->view->assign('data', $cObj->data);
    }
}