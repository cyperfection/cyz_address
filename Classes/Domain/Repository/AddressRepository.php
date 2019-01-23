<?php

namespace Cyz\CyzAddress\Domain\Repository;


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


class AddressRepository extends \FriendsOfTYPO3\TtAddress\Domain\Repository\AddressRepository
{
    protected $defaultOrderings = array('sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);

    function initializeObject()
    {
        /** @var \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings $querySettings */
        $querySettings = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings::class);
        $querySettings->setRespectStoragePage(FALSE);
        $querySettings->setRespectSysLanguage(FALSE);

        $this->setDefaultQuerySettings($querySettings);
    }

    /**
     * @param array [string] $pidlist
     * @param string [string] $sorting
     * @param string [string] $sortingColumn
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findInPidList($pidlist, $sorting = false, $sortingColumn = false)
    {
        $query = $this->createQuery();
        $query->matching($query->in('pid', $pidlist));

        if($sorting && $sortingColumn) {
            switch ($sorting) { 
                case 'ASC':
                    $query->setOrderings([
                        $sortingColumn => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
                    ]);
                    break;
                case 'DESC':
                    $query->setOrderings([
                        $sortingColumn => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
                    ]);
                    break;
                default:
                    break;
            }
        }
        
        return $query->execute();
    }

    /**
     * @param array [string] $uidlist
     * @param string [string] $sorting
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findInUidList($uidlist, $sorting = false)
    {
        $query = $this->createQuery();
        $query->matching($query->in('uid', $uidlist));

        if($sorting) {
            switch ($sorting) {
                case 'DESC':
                    $query->setOrderings([
                        'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
                    ]);
                    break;
                default:
                    $query->setOrderings([
                        'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
                    ]);
                    break;
            }
        }

        return $query->execute();
    }

    /**
     * @param array [string] $categories
     * @param string [string] $sorting
     * @param string [string] $sortingColumn
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findInCategories($categories, $logicalConstraint, $sorting = false, $sortingColumn = false)
    {
        $query = $this->createQuery();

        foreach ($categories as $category) {
            $constraints[] = $query->contains('categories', $category);
        }

        switch ($logicalConstraint) {
            case 'or':
                $query->matching($query->logicalOr($constraints));
                break;
            case 'and':
                $query->matching($query->logicalAnd($constraints));
                break;
        }

        if($sorting && $sortingColumn) {
            switch ($sorting) { 
                case 'ASC':
                    $query->setOrderings([
                        $sortingColumn => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
                    ]);
                    break;
                case 'DESC':
                    $query->setOrderings([
                        $sortingColumn => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
                    ]);
                    break;
                default:
                    break;
            }
        }

        return $query->execute();
    }

    /**
     * @param array [string] $uid
     * @return 
     */
    public function getFileReferences($uid) {
        $fileRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\FileRepository');
        $fileObjects = $fileRepository->findByRelation('tt_address', 'image', $uid);
        // get Imageobject information
        if(count($fileObjects) === 1) {
            $files = $fileObjects;
        } else {
            $files = array();
            foreach ($fileObjects as $key => $value) {
                $files[$key]['reference'] = $value->getReferenceProperties();
                $files[$key]['original'] = $value->getOriginalFile()->getProperties();
            }
        }

        return $files;
    }
}