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

                if (!empty($addresses)) {
                    $this->view->assign('addresses',
                        $this->addressRepository->findInUidList(explode(',', $addresses)));
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

                if (!empty($selection)) {
                    $this->view->assign('addresses',
                        $this->addressRepository->findInCategories(
                            explode(',', $selection),
                            $this->settings['groupSelectionConstraint']));
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

                if (!empty($pages)) {
                    $this->view->assign('addresses',
                        $this->addressRepository->findInPidList(explode(',', $pages)));
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
    }

    /**
     * show action
     *
     * @param \Cyz\CyzAddress\Domain\Model\Address $address
     */
    public function showAction(\Cyz\CyzAddress\Domain\Model\Address $address)
    {
        $this->view->assign('address', $address);
    }
}