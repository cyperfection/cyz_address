plugin.tx_cyzaddress {
    view {
        templateRootPaths.0 = EXT:cyz_address/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_cyzaddress.view.templateRootPath}
        partialRootPaths.0 = EXT:cyz_address/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_cyzaddress.view.partialRootPath}
        layoutRootPaths.0 = EXT:cyz_address/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_cyzaddress.view.layoutRootPath}
    }
}

config.tx_extbase {
    persistence {
        classes {
            Cyz\CyzAddress\Domain\Model\Address {
                mapping {
                    tableName = tt_address
                }
            }

            Cyz\CyzAddress\Domain\Model\Category {
                mapping {
                    tableName = sys_category
                }
            }
        }
    }
}

