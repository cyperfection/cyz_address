<?php

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

$EM_CONF[$_EXTKEY] = [
    'title' => 'tt_address fluid',
    'description' => 'Allows to use Fluid Templates with tt_address',
    'category' => 'plugin',
    'author' => 'Luca Kredel',
    'author_email' => 'luca.kredel@cyperfection.de',
    'state' => 'beta',
    'internal' => '',
    'uploadfolder' => '1',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '0.1.0',
    'constraints' => [
        'depends' => [
            'typo3' => '7.6.0-8.7.8',
            'fluid' => '7.6.22-',
            'tt_address' => '3.2.2-',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
