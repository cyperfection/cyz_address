<?php

namespace Cyz\CyzAddress\Hooks;

class RealUrlAutoConfiguration
{

    /**
     * Generates additional RealURL configuration and merges it with provided configuration
     *
     * @param       array $params Default configuration
     * @return      array Updated configuration
     */
    public function addAddressConfig($params)
    {
        $return = array_merge_recursive($params['config'], [
            'postVarSets' => [
                '_DEFAULT' => [
                    'address' => [
                        [
                            'GETvar' => 'tx_cyzaddress_address[action]',
                            'valueMap' => [
                                'show' => 'show',
                            ],
                            'noMatch' => 'bypass',
                        ],
                        [
                            'GETvar' => 'tx_cyzaddress_address[address]',
                            'lookUpTable' => [
                                'table' => 'tt_address',
                                'id_field' => 'uid',
                                'alias_field' => 'name',
                                'useUniqueCache' => 1,
                                'useUniqueCache_conf' => [
                                    'strtolower' => 1,
                                    'spaceCharacter' => '-',
                                ],
                            ],
                        ]
                    ]
                ]
            ]
        ]);
        return $return;
    }
}