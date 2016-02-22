<?php

$installer =  new Mage_Catalog_Model_Resource_Setup();
$installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'countdown_promo',array(
    'label'             => 'Configure date to show on count down popup ',
    'input'         => 'date',
    'type'          => 'datetime',
    'backend'           => 'eav/entity_attribute_backend_datetime',
    'frontend'          => '',
    'source'            => '',
    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible'           => true,
    'required'          => false,
    'user_defined'      => false,
    'searchable'        => false,
    'filterable'        => false,
    'comparable'        => false,
    'visible_on_front'  => false,
    'visible_in_advanced_search' => false,
    'unique'            => false
));

$installer->endSetup();

?>