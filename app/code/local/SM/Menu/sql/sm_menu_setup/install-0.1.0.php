<?php
$this->startSetup();
$this->addAttribute(
    Mage_Catalog_Model_Category::ENTITY,
    'type_dropdown_menu',
    array(
        'group' => "General Information",
        'input' => 'select',
        'option' => array(
            'value' => array(
                'type1'=> array(
                    0 =>'Display Products Sale'),
                'type2'=> array(
                    0 =>'Display all list'),
                'type3' => array(
                    0 =>'Display child'
                )
            ),

        ),
        'type' => 'int',
        'label' => 'Type dropdown menu',
        'backend' => '',
        'visible' => true,
        'required' => false,
        'visible_on_front' => false,
        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    )
);
$this->endSetup();