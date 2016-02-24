<?php


class ML_Homepage_Block_Adminhtml_Homepage_Edit_Tab_Form
    extends Mage_Adminhtml_Block_Widget_Form {
   
    protected function _prepareForm(){
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('homepage_');
        $form->setFieldNameSuffix('homepage');
        $this->setForm($form);
        $fieldset = $form->addFieldset('homepage_name', array('legend'=>Mage::helper('ml_homepage')->__('Name')));
        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig();

        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('ml_homepage')->__('Name'),
            'name'  => 'name',
            'required'  => true,
            'class' => 'required-entry',

        ));


        $template = $fieldset->addField('template', 'select', array(
            'name'  => 'template',
            'style' => 'display : none',
            'values'=> Mage::getModel('ml_homepage/homepage_attribute_source_template')->getAllOptions(true),
        ));

        $fieldset = $form->addFieldset('homepage_main_image', array('legend'=>Mage::helper('ml_homepage')->__('Main Image')));
        $fieldset->addType('image', Mage::getConfig()->getBlockClassName('ml_homepage/adminhtml_homepage_helper_image'));

        $fieldset->addField('main_image_enable', 'select', array(
            'label' => Mage::helper('ml_homepage')->__('Enable'),
            'name'  => 'main_image_enable',

            'values'=> array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('ml_homepage')->__('Yes'),
                ),
                array(
                    'value' => 0,
                    'label' => Mage::helper('ml_homepage')->__('No'),
                ),
            ),
        ));

        $fieldset->addField('main_image', 'image', array(
            'label' => Mage::helper('ml_homepage')->__('Main Image'),
            'name'  => 'main_image',

        ));
        $fieldset->addField('main_image_url', 'text', array(
            'label' => Mage::helper('ml_homepage')->__('Main Image Url'),
            'name'  => 'main_image_url',

        ));
        $fieldset->addField('nav_color', 'select', array(
            'label' => Mage::helper('ml_homepage')->__('Navigation Menu Color'),
            'name'  => 'nav_color',
            'values'=> array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('ml_homepage')->__('Black'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('ml_homepage')->__('White'),
                ),
            ),

        ));
        $slide_image_enable = $fieldset->addField('slide_image_enable', 'select', array(
            'label' => Mage::helper('ml_homepage')->__('Enable slide image'),
            'name'  => 'slide_image_enable',
            'values'=> array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('ml_homepage')->__('Yes'),
                ),
                array(
                    'value' => 0,
                    'label' => Mage::helper('ml_homepage')->__('No'),
                ),
            ),
        ));
        $slide_image = $fieldset->addField('slide_image', 'editor', array(
            'label' => Mage::helper('ml_homepage')->__('Slide image'),
            'name'  => 'slide_image',
            'config' => $wysiwygConfig,
        ));

        $fieldset = $form->addFieldset('homepage_promotion_list', array('legend'=>Mage::helper('ml_homepage')->__('Promotion list')));

        $fieldset->addField('promotion_list_enable', 'select', array(
            'label' => Mage::helper('ml_homepage')->__('Enable promotion'),
            'name'  => 'promotion_list_enable',

            'values'=> array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('ml_homepage')->__('Yes'),
                ),
                array(
                    'value' => 0,
                    'label' => Mage::helper('ml_homepage')->__('No'),
                ),
            ),
        ));

        $fieldset->addField('promotion_list', 'editor', array(
            'label' => Mage::helper('ml_homepage')->__('Promotion list'),
            'name'  => 'promotion_list',
            'config' => $wysiwygConfig,

        ));

        $fieldset = $form->addFieldset('homepage_video_list', array('legend'=>Mage::helper('ml_homepage')->__('Video list ')));

        $fieldset->addField('video_list_enable', 'select', array(
            'label' => Mage::helper('ml_homepage')->__('Enable video'),
            'name'  => 'video_list_enable',

            'values'=> array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('ml_homepage')->__('Yes'),
                ),
                array(
                    'value' => 0,
                    'label' => Mage::helper('ml_homepage')->__('No'),
                ),
            ),
        ));
        $fieldset->addField('video_list', 'editor', array(
            'label' => Mage::helper('ml_homepage')->__('Video list'),
            'name'  => 'video_list',
            'config' => $wysiwygConfig,

        ));

        $fieldset = $form->addFieldset('homepage_best_seller', array('legend'=>Mage::helper('ml_homepage')->__('Best seller')));
        $fieldset->addField('best_seller', 'select', array(
            'label' => Mage::helper('ml_homepage')->__('Enable'),
            'name'  => 'best_seller',

            'values'=> array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('ml_homepage')->__('Yes'),
                ),
                array(
                    'value' => 0,
                    'label' => Mage::helper('ml_homepage')->__('No'),
                ),
            ),
        ));

        $fieldset = $form->addFieldset('homepage_client_complain', array('legend'=>Mage::helper('ml_homepage')->__('Client complain')));

        $fieldset->addField('client_complain_enable', 'select', array(
            'label' => Mage::helper('ml_homepage')->__('Enable client complain'),
            'name'  => 'client_complain_enable',

            'values'=> array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('ml_homepage')->__('Yes'),
                ),
                array(
                    'value' => 0,
                    'label' => Mage::helper('ml_homepage')->__('No'),
                ),
            ),
        ));
        $fieldset->addField('client_complain', 'editor', array(
            'label' => Mage::helper('ml_homepage')->__('Client complain'),
            'name'  => 'client_complain',
            'config' => $wysiwygConfig,

        ));

        $fieldset = $form->addFieldset('homepage_featured_products', array('legend'=>Mage::helper('ml_homepage')->__('Featured Products')));

        $fieldset->addField('featured_products', 'select', array(
            'label' => Mage::helper('ml_homepage')->__('Enable Featured Products'),
            'name'  => 'featured_products',

            'values'=> array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('ml_homepage')->__('Yes'),
                ),
                array(
                    'value' => 0,
                    'label' => Mage::helper('ml_homepage')->__('No'),
                ),
            ),
        ));

        $fieldset = $form->addFieldset('homepage_hot deals', array('legend'=>Mage::helper('ml_homepage')->__('Hot deals')));

        $fieldset->addField('hot_deals', 'select', array(
            'label' => Mage::helper('ml_homepage')->__('Enable'),
            'name'  => 'hot_deals',

            'values'=> array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('ml_homepage')->__('Yes'),
                ),
                array(
                    'value' => 0,
                    'label' => Mage::helper('ml_homepage')->__('No'),
                ),
            ),
        ));


        $fieldset = $form->addFieldset('homepage_list_logo', array('legend'=>Mage::helper('ml_homepage')->__('List logo')));

        $fieldset->addField('list_logo_enable', 'select', array(
            'label' => Mage::helper('ml_homepage')->__('Enable list logo'),
            'name'  => 'list_logo_enable',

            'values'=> array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('ml_homepage')->__('Yes'),
                ),
                array(
                    'value' => 0,
                    'label' => Mage::helper('ml_homepage')->__('No'),
                ),
            ),
        ));
        $fieldset->addField('list_logo', 'editor', array(
            'label' => Mage::helper('ml_homepage')->__('List logo'),
            'name'  => 'list_logo',
            'config' => $wysiwygConfig,

        ));

        $formValues = Mage::registry('current_homepage')->getDefaultValues();
        if (!is_array($formValues)){
            $formValues = array();
        }
        if (Mage::getSingleton('adminhtml/session')->getHomepageData()){
            $formValues = array_merge($formValues, Mage::getSingleton('adminhtml/session')->getHomepageData());
            Mage::getSingleton('adminhtml/session')->setHomepageData(null);
        }
        elseif (Mage::registry('current_homepage')){
            $formValues = array_merge($formValues, Mage::registry('current_homepage')->getData());
        }
        $form->setValues($formValues);

        $this->setChild('form_after', $this->getLayout()->createBlock('adminhtml/widget_form_element_dependence')
                ->addFieldMap($template->getHtmlId(), $template->getName())
                ->addFieldMap($slide_image->getHtmlId(), $slide_image->getName())
                ->addFieldMap($slide_image_enable->getHtmlId(), $slide_image_enable->getName())
                ->addFieldDependence(
                    $slide_image_enable->getName(),
                    $template->getName(),
                    1
                )
                ->addFieldDependence(
                    $slide_image->getName(),
                    $template->getName(),
                    1
                )
        );
        Mage::log($template->getName(),null,'template.log');

        return parent::_prepareForm();
    }
}
