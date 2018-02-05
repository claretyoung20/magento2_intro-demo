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
     * @param $image_name
     * @return mixed
     */
    public function setImageName($image_name);

    public function getImageName();

    /**
     * @param $color
     * @return mixed
     */
    public function setColor($color);

    public function getColor();

    /**
     * @param $display_mode
     * @return mixed
     */
    public function setDisplayMode($display_mode);

    public function getDisplayMode();


}
