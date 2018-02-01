<?php

namespace Mageplaza\HelloWorld\Model\ResourceModel\Post;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Mageplaza\HelloWorld\Model\Post', 'Mageplaza\HelloWorld\Model\ResourceModel\Post');
    }
}
