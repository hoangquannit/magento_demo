<?php

class ML_Homepage_Model_Homepage_Attribute_Source_Template
    extends Mage_Eav_Model_Entity_Attribute_Source_Table {

    public function getAllOptions($withEmpty = true, $defaultValues = false){
        $options =  array(
            array(
                'label' => Mage::helper('ml_homepage')->__('Template 1'),
                'value' => 1
            ),
            array(
                'label' => Mage::helper('ml_homepage')->__('Template 2'),
                'value' => 2
            ),
            array(
                'label' => Mage::helper('ml_homepage')->__('Template 3'),
                'value' => 3
            ),
            array(
                'label' => Mage::helper('ml_homepage')->__('Template 4'),
                'value' => 4
            ),
            array(
                'label' => Mage::helper('ml_homepage')->__('Template 5'),
                'value' => 5
            ),
        );
        if ($withEmpty) {
            array_unshift($options, array('label'=>'', 'value'=>''));
        }
        return $options;

    }

    public function getOptionsArray($withEmpty = true) {
        $options = array();
        foreach ($this->getAllOptions($withEmpty) as $option) {
            $options[$option['value']] = $option['label'];
        }
        return $options;
    }

    public function getOptionText($value) {
        $options = $this->getOptionsArray();
        if (!is_array($value)) {
            $value = array($value);
        }
        $texts = array();
        foreach ($value as $v) {
            if (isset($options[$v])) {
                $texts[] = $options[$v];
            }
        }
        return implode(', ', $texts);
    }
}
