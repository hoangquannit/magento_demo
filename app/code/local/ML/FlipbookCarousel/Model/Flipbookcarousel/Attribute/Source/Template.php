<?php

class ML_FlipbookCarousel_Model_Flipbookcarousel_Attribute_Source_Template
    extends Mage_Eav_Model_Entity_Attribute_Source_Table {

    public function getAllOptions($withEmpty = true, $defaultValues = false){
        $options =  array(
            array(
                'label' => Mage::helper('ml_flipbookcarousel')->__('2 images'),
                'value' => 2
            ),
            array(
                'label' => Mage::helper('ml_flipbookcarousel')->__('1 image'),
                'value' => 1
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
