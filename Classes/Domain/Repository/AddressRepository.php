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


class AddressRepository extends \TYPO3\TtAddress\Domain\Repository\AddressRepository
{
    function initializeObject()
    {
        /** @var \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings $querySettings */
        $querySettings = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings::class);
        $querySettings->setRespectStoragePage(FALSE);

        $this->setDefaultQuerySettings($querySettings);
    }

    /**
     * @param array [string] $pidlist
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findInPidList($pidlist)
    {
        $query = $this->createQuery();
        $query->matching($query->in('pid', $pidlist));

        return $query->execute();
    }

    /**
     * @param array [string] $uidlist
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findInUidList($uidlist)
    {
        $query = $this->createQuery();
        $query->matching($query->in('uid', $uidlist));

        return $query->execute();
    }

    /**
     * @param array [string] $categories
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findInCategories($categories, $logicalConstraint)
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


        return $query->execute();
    }

}