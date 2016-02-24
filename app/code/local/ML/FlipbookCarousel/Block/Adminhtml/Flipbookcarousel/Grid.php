<?php

class ML_FlipbookCarousel_Block_Adminhtml_Flipbookcarousel_Grid
    extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct(){
        parent::__construct();
        $this->setId('flipbookcarouselGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection(){
        $collection = Mage::getModel('ml_flipbookcarousel/flipbookcarousel')->getCollection()->setOrder('template','asc');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns(){
        $this->addColumn('entity_id', array(
            'header'    => Mage::helper('ml_flipbookcarousel')->__('Id'),
            'index'        => 'entity_id',
            'type'        => 'number'
        ));
        $this->addColumn('name', array(
            'header'    => Mage::helper('ml_flipbookcarousel')->__('Content'),
            'align'     => 'left',
            'renderer'  => new ml_FlipbookCarousel_Block_Adminhtml_Renderer_Content()
        ));
        $this->addColumn('content', array(
            'header'    => Mage::helper('ml_flipbookcarousel')->__('Item Name'),
            'align'     => 'left',
            'index'     => 'name',
        ));
        $this->addColumn('status', array(
            'header'    => Mage::helper('ml_flipbookcarousel')->__('Status'),
            'index'        => 'status',
            'type'        => 'options',
            'options'    => array(
                '1' => Mage::helper('ml_flipbookcarousel')->__('Enabled'),
                '0' => Mage::helper('ml_flipbookcarousel')->__('Disabled'),
            )
        ));
        $this->addColumn('template', array(
            'header'=> Mage::helper('ml_flipbookcarousel')->__('Template'),
            'index' => 'template',
            'type'  => 'options',
            'options' => Mage::helper('ml_flipbookcarousel')->convertOptions(Mage::getModel('ml_flipbookcarousel/flipbookcarousel_attribute_source_template')->getAllOptions(false))

        ));
        $this->addColumn('item_order', array(
            'header'=> Mage::helper('ml_flipbookcarousel')->__('Order'),
            'index' => 'item_order',
            'type'=> 'number',

        ));
        $this->addColumn('type', array(
            'header'=> Mage::helper('ml_flipbookcarousel')->__('Type'),
            'index' => 'type',
            'type'  => 'options',
            'options' => Mage::helper('ml_flipbookcarousel')->convertOptions(Mage::getModel('ml_flipbookcarousel/flipbookcarousel_attribute_source_type')->getAllOptions(false))

        ));
        if (!Mage::app()->isSingleStoreMode() && !$this->_isExport) {
            $this->addColumn('store_id', array(
                'header'=> Mage::helper('ml_flipbookcarousel')->__('Store Views'),
                'index' => 'store_id',
                'type'  => 'store',
                'store_all' => true,
                'store_view'=> true,
                'sortable'  => false,
                'filter_condition_callback'=> array($this, '_filterStoreCondition'),
            ));
        }
        $this->addColumn('created_at', array(
            'header'    => Mage::helper('ml_flipbookcarousel')->__('Created at'),
            'index'     => 'created_at',
            'width'     => '120px',
            'type'      => 'datetime',
        ));
        $this->addColumn('updated_at', array(
            'header'    => Mage::helper('ml_flipbookcarousel')->__('Updated at'),
            'index'     => 'updated_at',
            'width'     => '120px',
            'type'      => 'datetime',
        ));
        $this->addColumn('action',
            array(
                'header'=>  Mage::helper('ml_flipbookcarousel')->__('Action'),
                'width' => '100',
                'type'  => 'action',
                'getter'=> 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('ml_flipbookcarousel')->__('Edit'),
                        'url'   => array('base'=> '*/*/edit'),
                        'field' => 'id'
                    )
                ),
                'filter'=> false,
                'is_system'    => true,
                'sortable'  => false,
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction(){
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('flipbookcarousel');
        $this->getMassactionBlock()->addItem('delete', array(
            'label'=> Mage::helper('ml_flipbookcarousel')->__('Delete'),
            'url'  => $this->getUrl('*/*/massDelete'),
            'confirm'  => Mage::helper('ml_flipbookcarousel')->__('Are you sure?')
        ));
        $this->getMassactionBlock()->addItem('status', array(
            'label'=> Mage::helper('ml_flipbookcarousel')->__('Change status'),
            'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
            'additional' => array(
                'status' => array(
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => Mage::helper('ml_flipbookcarousel')->__('Status'),
                        'values' => array(
                                '1' => Mage::helper('ml_flipbookcarousel')->__('Enabled'),
                                '0' => Mage::helper('ml_flipbookcarousel')->__('Disabled'),
                        )
                )
            )
        ));
        $this->getMassactionBlock()->addItem('template', array(
            'label'=> Mage::helper('ml_flipbookcarousel')->__('Change Template'),
            'url'  => $this->getUrl('*/*/massTemplate', array('_current'=>true)),
            'additional' => array(
                'flag_template' => array(
                        'name' => 'flag_template',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => Mage::helper('ml_flipbookcarousel')->__('Template'),
                        'values' => Mage::getModel('ml_flipbookcarousel/flipbookcarousel_attribute_source_template')->getAllOptions(true),

                )
            )
        ));
        return $this;
    }

    public function getRowUrl($row){
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    public function getGridUrl(){
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

    protected function _afterLoadCollection(){
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }

    protected function _filterStoreCondition($collection, $column){
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }
        $collection->addStoreFilter($value);
        return $this;
    }
}
