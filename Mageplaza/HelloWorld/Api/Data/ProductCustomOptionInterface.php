<?php
/**
 * Created by PhpStorm.
 * User: claretyoung
 * Date: 22/02/2018
 * Time: 10:43
 */

namespace Mageplaza\HelloWorld\Api\Data;


interface ProductCustomOptionInterface extends  \Magento\Catalog\Api\Data\ProductCustomOptionInterface
{

    const OPTION_TYPE_THUMB_GALLERY = 'thumb_gallery';

    const OPTION_TYPE_THUMB_GALLERY_POPUP = 'thumb_gallery_popup';

    const OPTION_TYPE_THUMB_GALLERY_MULTI = 'thumb_gallery_multi';

}