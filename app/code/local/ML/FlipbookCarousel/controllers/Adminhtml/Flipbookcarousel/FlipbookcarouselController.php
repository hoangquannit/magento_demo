<?php

class ML_FlipbookCarousel_Adminhtml_Flipbookcarousel_FlipbookcarouselController
    extends ML_FlipbookCarousel_Controller_Adminhtml_FlipbookCarousel {

    protected function _initFlipbookcarousel(){
        $flipbookcarouselId  = (int) $this->getRequest()->getParam('id');
        $flipbookcarousel    = Mage::getModel('ml_flipbookcarousel/flipbookcarousel');
        if ($flipbookcarouselId) {
            $flipbookcarousel->load($flipbookcarouselId);
        }
        Mage::register('current_flipbookcarousel', $flipbookcarousel);
        return $flipbookcarousel;
    }

    public function indexAction() {
        $this->loadLayout();
        $this->_title(Mage::helper('ml_flipbookcarousel')->__('Flipbook Carousel Manager'))
             ->_title(Mage::helper('ml_flipbookcarousel')->__('Flipbook Carousels'));
        $this->renderLayout();
    }

    public function gridAction() {
        $this->loadLayout()->renderLayout();
    }

    public function editAction() {
        $flipbookcarouselId    = $this->getRequest()->getParam('id');
        $flipbookcarousel      = $this->_initFlipbookcarousel();
        if ($flipbookcarouselId && !$flipbookcarousel->getId()) {
            $this->_getSession()->addError(Mage::helper('ml_flipbookcarousel')->__('This flipbook carousel no longer exists.'));
            $this->_redirect('*/*/');
            return;
        }
        $data = Mage::getSingleton('adminhtml/session')->getFlipbookcarouselData(true);
        if (!empty($data)) {
            $flipbookcarousel->setData($data);
        }
        Mage::register('flipbookcarousel_data', $flipbookcarousel);
        $this->loadLayout();
        $this->_title(Mage::helper('ml_flipbookcarousel')->__('Flipbook Carousel Manager'))
             ->_title(Mage::helper('ml_flipbookcarousel')->__('Flipbook Carousels'));
        if ($flipbookcarousel->getId()){
            $this->_title($flipbookcarousel->getName());
        }
        else{
            $this->_title(Mage::helper('ml_flipbookcarousel')->__('Add flipbook carousel'));
        }
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        $this->renderLayout();
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function saveAction() {
        if ($data = $this->getRequest()->getPost('flipbookcarousel')) {
            try {
                $flipbookcarousel = $this->_initFlipbookcarousel();
                $flipbookcarousel->addData($data);
                $imageName = $this->_uploadAndGetName('image', Mage::helper('ml_flipbookcarousel/flipbookcarousel_image')->getImageBaseDir(), $data);
                $flipbookcarousel->setData('image', $imageName);
                $videoName = $this->_uploadAndGetName('video', Mage::helper('ml_flipbookcarousel/flipbookcarousel')->getFileBaseDir(), $data);
                $flipbookcarousel->setData('video', $videoName);
                $posterName = $this->_uploadAndGetName('poster', Mage::helper('ml_flipbookcarousel/flipbookcarousel_image')->getImageBaseDir(), $data);
                $flipbookcarousel->setData('poster', $posterName);
                $flipbookcarousel->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('ml_flipbookcarousel')->__('Flipbook Carousel was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $flipbookcarousel->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            }
            catch (Mage_Core_Exception $e){
                if (isset($data['image']['value'])){
                    $data['image'] = $data['image']['value'];
                }
                if (isset($data['video']['value'])){
                    $data['video'] = $data['video']['value'];
                }
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFlipbookcarouselData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
            catch (Exception $e) {
                Mage::logException($e);
                if (isset($data['image']['value'])){
                    $data['image'] = $data['image']['value'];
                }
                if (isset($data['video']['value'])){
                    $data['video'] = $data['video']['value'];
                }
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ml_flipbookcarousel')->__('There was a problem saving the flipbook carousel.'));
                Mage::getSingleton('adminhtml/session')->setFlipbookcarouselData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ml_flipbookcarousel')->__('Unable to find flipbook carousel to save.'));
        $this->_redirect('*/*/');
    }

    public function deleteAction() {
        if( $this->getRequest()->getParam('id') > 0) {
            try {
                $flipbookcarousel = Mage::getModel('ml_flipbookcarousel/flipbookcarousel');
                $flipbookcarousel->setId($this->getRequest()->getParam('id'))->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('ml_flipbookcarousel')->__('Flipbook Carousel was successfully deleted.'));
                $this->_redirect('*/*/');
                return;
            }
            catch (Mage_Core_Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ml_flipbookcarousel')->__('There was an error deleting flipbook carousel.'));
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                Mage::logException($e);
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ml_flipbookcarousel')->__('Could not find flipbook carousel to delete.'));
        $this->_redirect('*/*/');
    }

    public function massDeleteAction() {
        $flipbookcarouselIds = $this->getRequest()->getParam('flipbookcarousel');
        if(!is_array($flipbookcarouselIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ml_flipbookcarousel')->__('Please select flipbook carousels to delete.'));
        }
        else {
            try {
                foreach ($flipbookcarouselIds as $flipbookcarouselId) {
                    $flipbookcarousel = Mage::getModel('ml_flipbookcarousel/flipbookcarousel');
                    $flipbookcarousel->setId($flipbookcarouselId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('ml_flipbookcarousel')->__('Total of %d flipbook carousels were successfully deleted.', count($flipbookcarouselIds)));
            }
            catch (Mage_Core_Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ml_flipbookcarousel')->__('There was an error deleting flipbook carousels.'));
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massStatusAction(){
        $flipbookcarouselIds = $this->getRequest()->getParam('flipbookcarousel');
        if(!is_array($flipbookcarouselIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ml_flipbookcarousel')->__('Please select flipbook carousels.'));
        }
        else {
            try {
                foreach ($flipbookcarouselIds as $flipbookcarouselId) {
                $flipbookcarousel = Mage::getSingleton('ml_flipbookcarousel/flipbookcarousel')->load($flipbookcarouselId)
                            ->setStatus($this->getRequest()->getParam('status'))
                            ->setImlassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d flipbook carousels were successfully updated.', count($flipbookcarouselIds)));
            }
            catch (Mage_Core_Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ml_flipbookcarousel')->__('There was an error updating flipbook carousels.'));
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massTemplateAction(){
        $flipbookcarouselIds = $this->getRequest()->getParam('flipbookcarousel');
        if(!is_array($flipbookcarouselIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ml_flipbookcarousel')->__('Please select flipbook carousels.'));
        }
        else {
            try {
                foreach ($flipbookcarouselIds as $flipbookcarouselId) {
                $flipbookcarousel = Mage::getSingleton('ml_flipbookcarousel/flipbookcarousel')->load($flipbookcarouselId)
                            ->setTemplate($this->getRequest()->getParam('flag_template'))
                            ->setImlassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d flipbook carousels were successfully updated.', count($flipbookcarouselIds)));
            }
            catch (Mage_Core_Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ml_flipbookcarousel')->__('There was an error updating flipbook carousels.'));
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massTypeAction(){
        $flipbookcarouselIds = $this->getRequest()->getParam('flipbookcarousel');
        if(!is_array($flipbookcarouselIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ml_flipbookcarousel')->__('Please select flipbook carousels.'));
        }
        else {
            try {
                foreach ($flipbookcarouselIds as $flipbookcarouselId) {
                $flipbookcarousel = Mage::getSingleton('ml_flipbookcarousel/flipbookcarousel')->load($flipbookcarouselId)
                            ->setType($this->getRequest()->getParam('flag_type'))
                            ->setImlassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d flipbook carousels were successfully updated.', count($flipbookcarouselIds)));
            }
            catch (Mage_Core_Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ml_flipbookcarousel')->__('There was an error updating flipbook carousels.'));
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    public function exportCsvAction(){
        $fileName   = 'flipbookcarousel.csv';
        $content    = $this->getLayout()->createBlock('ml_flipbookcarousel/adminhtml_flipbookcarousel_grid')->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportExcelAction(){
        $fileName   = 'flipbookcarousel.xls';
        $content    = $this->getLayout()->createBlock('ml_flipbookcarousel/adminhtml_flipbookcarousel_grid')->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportXmlAction(){
        $fileName   = 'flipbookcarousel.xml';
        $content    = $this->getLayout()->createBlock('ml_flipbookcarousel/adminhtml_flipbookcarousel_grid')->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('cms/ml_flipbookcarousel/flipbookcarousel');
    }
}
