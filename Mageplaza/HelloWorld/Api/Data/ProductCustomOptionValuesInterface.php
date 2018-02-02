<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Mageplaza\HelloWorld\Api\Data;

/**
 * @api
 * @since 100.0.2
 */
interface ProductCustomOptionValuesInterface extends  \Magento\Catalog\Api\Data\ProductCustomOptionValuesInterface
{

    /**
     * @param $quantity
     * @return mixed
     */
    public function setQuantity($quantity);

    public function getQuantity();

    /**
     * @param $color
     * @return mixed
     */
    public function setColor($color);

    public function getColor();


}
