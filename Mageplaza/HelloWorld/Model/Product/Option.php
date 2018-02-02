<?php
/**
 * Created by PhpStorm.
 * User: claretyoung
 * Date: 02/02/2018
 * Time: 14:44
 */

namespace Mageplaza\HelloWorld\Model\Product;


class Option extends \Magento\Catalog\Model\Product\Option
{

    /**
     * @param \Mageplaza\HelloWorld\Api\Data\ProductCustomOptionValuesInterface[] $values
     * @return $this
     */
    public function setValues(array $values = null)
    {
        $this->values = $values;
        return $this;
    }


}