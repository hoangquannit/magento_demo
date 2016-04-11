<?php

class SM_Blog_Adminhtml_PostController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Blog Manager'));
        $this->loadLayout();
        $this->_setActiveMenu('blog');
        $this->_addContent($this->getLayout()->createBlock('blog/adminhtml_post'));
        $this->renderLayout();
    }


    public function editAction()
    {

        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('sm_blog/post')->load($id);
        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if ($data) {
                $model->setData($data)->setId($id);
            }
        }
        else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('blog')->__('Example does not exist'));
            $this->_redirect('*/*/');
        }
        Mage::register('post_data', $model);
        $this->loadLayout();
        $this->_setActiveMenu('blog/adminhtml_post');
        $this->_addContent($this->getLayout()->createBlock('blog/adminhtml_post_edit'));
        $this->_addLeft($this->getLayout()->createBlock('blog/adminhtml_post_edit_tabs'));
        $this->renderLayout();


    }

    public function saveAction()
    {
        $data        = $this->getRequest()->getPost();
        $postId      = $this->getRequest()->getParam('id');
        $postProduct = $this->getRequest()->getParam('related_product');
        if($postProduct != null) {
            $postProduct = implode(',',$postProduct);
            $data['related_product']    = $postProduct;
        }
//        upload images
        if($_FILES['avatar']['name'] != null) {
            try {
                $uploader = new Varien_File_Uploader('avatar');
                $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
                $uploader->setAllowRenameFiles(false);
                $uploader->setFilesDispersion(false);
                $path = Mage::getBaseDir('media');
                if (!file_exists($path.'\blogs')) {
                    mkdir($path.'\blogs', 0777, true);
                    $path = $path.'\blogs';
                } else {
                    $path = $path.'\blogs';
                }
                $data['image'] = time().'_'.$_FILES['avatar']['name'];
                $uploader->save($path, $data['image']);
            } catch(Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
            }
        }

        try {
            $postModel = Mage::getModel('sm_blog/post');
            $postModel->setData($data);
            if($postId){
                $postModel->setId($postId);
            }
            $postModel->save();
            $message = $this->__('Post was successfully saved.');
            Mage::getSingleton('adminhtml/session')->addSuccess($message);
            Mage::getSingleton('adminhtml/session')->setFormData(false);
            $this->_redirect('*/*/');
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFormData($data);
        }
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                $model = Mage::getModel('sm_blog/post');
                $model->setId($id);
                $model->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('blog')->__('The post has been deleted.'));
                $this->_redirect('*/*/');
                return;
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Unable to find the post to delete.'));
        $this->_redirect('*/*/');
    }


    public function massDeleteAction()
    {
        $Ids = $this->getRequest()->getParam('posts_id');
        if(!is_array($Ids)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('vendors')->__('Please select post !'));
        } else {
            try {
                foreach ($Ids as $Id) {
                    Mage::getModel('sm_blog/post')->load($Id)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('tax')->__(
                        'Total of %d record(s) were deleted.', count($Ids)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function abc() {
        $Ids = $this->getRequest()->getParam('related_product');
        var_dump($Ids);
        die('dfgdfgd');
    }
}