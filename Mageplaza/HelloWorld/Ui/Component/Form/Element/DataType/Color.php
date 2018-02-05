<?php
/**
 * Created by PhpStorm.
 * User: claretyoung
 * Date: 05/02/2018
 * Time: 10:13
 */

namespace Mageplaza\HelloWorld\Ui\Component\Form\Element\DataType;

use Magento\Ui\Component\Form\Element\DataType\AbstractDataType;

class Color extends AbstractDataType
{
    const NAME = 'color';

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