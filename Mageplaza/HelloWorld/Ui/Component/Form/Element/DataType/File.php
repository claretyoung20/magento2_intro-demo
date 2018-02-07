<?php
/**
 * Created by PhpStorm.
 * User: claretyoung
 * Date: 07/02/2018
 * Time: 11:07
 */

namespace Mageplaza\HelloWorld\Ui\Component\Form\Element\DataType;

use Magento\Ui\Component\Form\Element\DataType\AbstractDataType;

class File extends AbstractDataType
{
    const NAME = 'file';

    /**
     * Get component name
     *
     * @return string
     */
    public function getComponentName()
    {
        return static::NAME;
    }
}