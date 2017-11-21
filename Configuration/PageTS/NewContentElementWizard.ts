mod.wizards {
    newContentElement.wizardItems {
        plugins {
            elements {
                plugins_tx_cyzaddress {
                    iconIdentifier = ext-new-wizard-icon
                    title = LLL:EXT:cyz_address/Resources/Private/Language/locallang_db.xlf:cyz_address.wiz_title
                    description = LLL:EXT:cyz_address/Resources/Private/Language/locallang_db.xlf:cyz_address.wiz_description
                    tt_content_defValues {
                        CType = list
                        list_type = cyzaddress_address
                    }
                }
            }
        }
    }
}