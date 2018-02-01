<?php
namespace Mageplaza\HelloWorld\Block\Adminhtml;

class Post extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_post';
        $this->_blockGroup = 'Toptal_Blog';
        $this->_headerText = __('Blog Post');
        $this->_addButtonLabel = __('Create New Post');
        parent::_construct();
    }
}
