<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Mageplaza\HelloWorld\Ui\DataProvider\Product\Form\Modifier;


use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Catalog\Model\ProductOptions\ConfigInterface;
use Magento\Catalog\Model\Config\Source\Product\Options\Price as ProductOptionsPrice;
use Magento\Framework\UrlInterface;
use Magento\Framework\Stdlib\ArrayManager;
use Magento\Ui\Component\Modal;
use Magento\Ui\Component\Container;
use Magento\Ui\Component\DynamicRows;
use Magento\Ui\Component\Form\Fieldset;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Element\Input;
use Magento\Ui\Component\Form\Element\Select;
use Magento\Ui\Component\Form\Element\Checkbox;
use Magento\Ui\Component\Form\Element\ActionDelete;
use Magento\Ui\Component\Form\Element\DataType\Text;
use Magento\Ui\Component\Form\Element\DataType\Number;
use Magento\Framework\Locale\CurrencyInterface;
use Mageplaza\HelloWorld\Ui\Component\Form\Element\DataType\Color;
use Mageplaza\HelloWorld\Ui\Component\Form\Element\DataType\File;


class CustomOptions extends \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\CustomOptions
{
    /**#@+
     * Field values
     *
     */
    const FIELD_IMAGE_NAME = 'image_name';
    const FIELD_COLOR_NAME = 'color';
    const FIELD_DISPLAY_NAME = 'display_mode';
    const FIELD_MODE_COLOR = 'color';
    const FIELD_MODE_IMAGE = 'image';
    const FIELD_FILE_UPLOADER = 'fileUpload';

    /**
     * CustomOptions constructor.
     * @param LocatorInterface $locator
     * @param StoreManagerInterface $storeManager
     * @param ConfigInterface $productOptionsConfig
     * @param ProductOptionsPrice $productOptionsPrice
     * @param UrlInterface $urlBuilder
     * @param ArrayManager $arrayManager
     */
    public function __construct(
        LocatorInterface $locator,
        StoreManagerInterface $storeManager,
        ConfigInterface $productOptionsConfig,
        ProductOptionsPrice $productOptionsPrice,
        UrlInterface $urlBuilder,
        ArrayManager $arrayManager
    )
    {
        parent::__construct($locator, $storeManager, $productOptionsConfig, $productOptionsPrice, $urlBuilder, $arrayManager);
    }

    public function showImage($sortOrder)
    {
        return ['arguments' => [
            'data' => [
                'config' => [
                    'label' => __('Upload'),
                    'componentType' => Field::NAME,
                    'formElement' => File::NAME,
                    'dataScope' => static::FIELD_IMAGE_NAME,
                    'sortOrder' => $sortOrder,
                    'template' => 'Mageplaza_HelloWorld/form/element/showImage',
                    'component' => 'Mageplaza_HelloWorld/js/form/element/showImage'
                ],
            ],
        ],
        ];
    }

    protected function getSelectTypeGridConfig($sortOrder)
    {
        $options = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'imports' => [
                            'optionId' => '${ $.provider }:${ $.parentScope }.option_id',
                            'optionTypeId' => '${ $.provider }:${ $.parentScope }.option_type_id',
                            'isUseDefault' => '${ $.provider }:${ $.parentScope }.is_use_default'
                        ],
                        'service' => [
                            'template' => 'Magento_Catalog/form/element/helper/custom-option-type-service',
                        ],
                    ],
                ],
            ],
        ];

        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'addButtonLabel' => __('Add Value'),
                        'componentType' => DynamicRows::NAME,
                        'component' => 'Magento_Ui/js/dynamic-rows/dynamic-rows',
                        'additionalClasses' => 'admin__field-wide',
                        'deleteProperty' => static::FIELD_IS_DELETE,
                        'deleteValue' => '1',
                        'renderDefaultRecord' => false,
                        'sortOrder' => $sortOrder,
                    ],
                ],
            ],
            'children' => [
                'record' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'componentType' => Container::NAME,
                                'component' => 'Magento_Ui/js/dynamic-rows/record',
                                'positionProvider' => static::FIELD_SORT_ORDER_NAME,
                                'isTemplate' => true,
                                'is_collection' => true,
                            ],
                        ],
                    ],
                    'children' => [
                        static::FIELD_TITLE_NAME => $this->getTitleFieldConfig(10, $this->locator->getProduct()->getStoreId() ? $options : []),
                        static::FIELD_PRICE_NAME => $this->getPriceFieldConfigForSelectType(20),
                        static::FIELD_PRICE_TYPE_NAME => $this->getPriceTypeFieldConfig(30, ['fit' => true]),
                        static::FIELD_SKU_NAME => $this->getSkuFieldConfig(40),
                        static::FIELD_SORT_ORDER_NAME => $this->getPositionFieldConfig(50),
                        static::FIELD_IMAGE_NAME => $this->getImageNameFieldConfig(55),
                        static::FIELD_IMAGE_NAME => $this->fileUploader(60),
//                        static::FIELD_IMAGE_NAME => $this ->showImage(65),
                        static::FIELD_COLOR_NAME => $this->getColorFieldConfig(65),
                        static::FIELD_DISPLAY_NAME => $this->getDisplayNameFieldConfig(70),
                        static::FIELD_IS_DELETE => $this->getIsDeleteFieldConfig(75)

                    ]
                ]
            ]
        ];
    }

    public function fileUploader($sortOrder)
    {
        return ['arguments' => [
            'data' => [
                'config' => [
                    'label' => __('Upload'),
                    'componentType' => Field::NAME,
                    'formElement' => File::NAME,
                    'dataScope' => static::FIELD_IMAGE_NAME,
                    'sortOrder' => $sortOrder,
                    'template' => 'Mageplaza_HelloWorld/form/element/media',
                    'component' => 'Mageplaza_HelloWorld/js/form/element/media',
                    'uploaderConfig' => [
                        'url' => 'Mageplaza/HelloWorld/Controller/Saveimage'
                    ],
                ],

            ],
        ],
        ];
    }

    /**
     * @param $sortOrder
     * @return array
     */
    protected function getImageNameFieldConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Image'),
                        'componentType' => Field::NAME,
                        'formElement' => Input::NAME,
                        'dataScope' => static::FIELD_IMAGE_NAME,
                        'dataType' => Text::NAME,
                        'sortOrder' => $sortOrder,
                    ],
                ],
            ],
        ];
    }


    /**
     * @param $sortOrder
     * @return array
     */
    protected function getColorFieldConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Thumb Color'),
                        'componentType' => Field::NAME,
                        'formElement' => 'input',
                        'dataScope' => static::FIELD_COLOR_NAME,
                        'sortOrder' => $sortOrder,
                        'template' => 'Mageplaza_HelloWorld/form/element/colorPicker',
                        'component' => 'Mageplaza_HelloWorld/js/form/element/colorPicker'
                    ],
                ],
            ],
        ];
    }

    /**
     * @param $sortOrder
     * @return array
     */
    protected function getDisplayNameFieldConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Display Mode'),
                        'componentType' => Field::NAME,
                        'formElement' => Select::NAME,
                        'dataScope' => static::FIELD_DISPLAY_NAME,
                        'dataType' => Text::NAME,
                        'sortOrder' => $sortOrder,
                        'options' => $this->toOptionArray(),
                    ],
                ],
            ],
        ];
    }

    public function toOptionArray()
    {
        return [
            ['value' => self::FIELD_MODE_IMAGE, 'label' => __('Image')],
            ['value' => self::FIELD_MODE_COLOR, 'label' => __('Color')],
        ];
    }
}