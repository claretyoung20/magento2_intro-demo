<?php

namespace Mageplaza\HelloWorld\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Post extends AbstractDb
{


    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('mageplaza_helloworld_post', 'post_id');
    }


}

