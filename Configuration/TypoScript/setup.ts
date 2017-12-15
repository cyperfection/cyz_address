plugin.tx_cyzaddress {
    view {
        templateRootPaths.0 = EXT:cyz_address/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_cyzaddress.view.templateRootPath}
        partialRootPaths.0 = EXT:cyz_address/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_cyzaddress.view.partialRootPath}
        layoutRootPaths.0 = EXT:cyz_address/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_cyzaddress.view.layoutRootPath}
    }

    settings {
        defaultProfilePicture {
            active = {$plugin.tx_cyzaddress.settings.defaultProfilePicture.active}
            path = {$plugin.tx_cyzaddress.settings.defaultProfilePicture.path}
            width = {$plugin.tx_cyzaddress.settings.defaultProfilePicture.width}
            height = {$plugin.tx_cyzaddress.settings.defaultProfilePicture.height}
        }
    }

    features {
        skipDefaultArguments = 1
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
