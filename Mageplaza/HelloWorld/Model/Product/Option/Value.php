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
    const KEY_IMAGE_NAME = 'image_name';
    const KEY_COLOR = 'color';
    const KEY_DISPLAY_MODE = 'display_mode';


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

    /**
     * @param $image_name
     * @return mixed
     */
    public function setImageName($image_name)
    {
        return $this->setData(self::KEY_IMAGE_NAME, $image_name);
    }

    public function getImageName()
    {
        return $this->_getData(self::KEY_IMAGE_NAME);
    }

    /**
     * @param $display_mode
     * @return mixed
     */
    public function setDisplayMode($display_mode)
    {
        return $this->setData(self::KEY_DISPLAY_MODE, $display_mode);
    }

    public function getDisplayMode()
    {
        return $this->_getData(self::KEY_DISPLAY_MODE);
    }
}