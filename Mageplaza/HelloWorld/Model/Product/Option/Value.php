<?php
/**
 * Created by PhpStorm.
 * User: claretyoung
 * Date: 02/02/2018
 * Time: 11:22
 */

namespace Mageplaza\HelloWorld\Model\Product\Option;


use Mageplaza\HelloWorld\Api\Data\ProductCustomOptionValuesInterface;

class Value extends \Magento\Catalog\Model\Product\Option\Value implements ProductCustomOptionValuesInterface
{
    const KEY_QUANTITY = 'quantity';
    const KEY_COLOR = 'color';

    /**
     * @param $quantity
     * @return mixed
     */
    public function setQuantity($quantity)
    {
        return $this->setData(self::KEY_QUANTITY, $quantity);

    }

    public function getQuantity()
    {
        return $this->_getData(self::KEY_QUANTITY);
    }

    /**
     * @param $color
     * @return mixed
     */
    public function setColor($color)
    {
        return $this->setData(self::KEY_COLOR, $color);
    }

    public function getColor()
    {
        return $this->_getData(self::KEY_COLOR);
    }
}