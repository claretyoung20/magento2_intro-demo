<?php

namespace Mageplaza\HelloWorld\Model;

use \Magento\Framework\Model\AbstractModel;

class Post extends AbstractModel
{


    /**
     * Initialize resource model
     * @return void
     */
    public function _construct()
    {
        $this->_init('Mageplaza\HelloWorld\Model\ResourceModel\Post');
    }


}

