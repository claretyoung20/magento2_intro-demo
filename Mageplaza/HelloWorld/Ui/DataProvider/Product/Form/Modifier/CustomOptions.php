<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Mageplaza\HelloWorld\Ui\DataProvider\Product\Form\Modifier;


use Magento\Ui\Component\Container;
use Magento\Ui\Component\DynamicRows;;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Element\Input;
use Magento\Ui\Component\Form\Element\Select;
use Magento\Ui\Component\Form\Element\DataType\Text;



class CustomOptions extends \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\CustomOptions
{
    /**#@+
     * Field values
     *
     */
    const FIELD_IMAGE_NAME = 'image_name';
    const FIELD_UPLOADER = 'uploader';
    const FIELD_COLOR_NAME = 'color';
    const FIELD_DISPLAY_NAME = 'display_mode';
    const FIELD_MODE_COLOR = 'color';
    const FIELD_MODE_IMAGE = 'image';
    const FIELD_FILE_UPLOADER = 'fileUpload';



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


                        static::FIELD_UPLOADER => $this->fileUploader(55),
                        static::FIELD_IMAGE_NAME => $this->getImageUrl(60),

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
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'component' => 'Mageplaza_HelloWorld/js/form/element/file-upload',
                        'componentType' => Field::NAME,
                        'template'   => 'Mageplaza_HelloWorld/form/element/media',
                        'formElement'   => 'fileUploader',
                        'dataType'      => Text::NAME,
                        'sortOrder'     => $sortOrder,
                        'uploaderConfig'     => [
                            'url' => 'mageplaza_helloworld/Upload/Saveimage'
                        ],
                    ],
                ],
            ],
        ];
    }


    protected function getImageUrl($sortOrder)
    {

        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label'         => 'image',
                        'component'     => 'Mageplaza_HelloWorld/js/form/element/showImage',
                        'elementTmpl'   => 'Mageplaza_HelloWorld/form/element/showImage',
                        'componentType' => Field::NAME,
                        'formElement'   => Input::NAME,
                        'dataType'      => Text::NAME,
                        'sortOrder'     => $sortOrder,
                        'dataScope'     => static::FIELD_IMAGE_NAME,
                        'imports'       => [
                            'base_url'  => $this->storeManager->getStore()->getBaseUrl(),
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

    /**
     * Get config for "Option Type" field
     *
     * @param int $sortOrder
     * @return array
     * @since 101.0.0
     */
    protected function getTypeFieldConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Option Type'),
                        'componentType' => Field::NAME,
                        'formElement' => Select::NAME,
                        'component' => 'Magento_Catalog/js/custom-options-type',
                        'elementTmpl' => 'ui/grid/filters/elements/ui-select',
                        'selectType' => 'optgroup',
                        'dataScope' => static::FIELD_TYPE_NAME,
                        'dataType' => Text::NAME,
                        'sortOrder' => $sortOrder,
                        'options' => $this->getProductOptionTypes(),
                        'disableLabel' => true,
                        'multiple' => false,
                        'selectedPlaceholders' => [
                            'defaultPlaceholder' => __('-- Please select --'),
                        ],
                        'validation' => [
                            'required-entry' => true
                        ],
                        'groupsConfig' => [
                            'text' => [
                                'values' => ['field', 'area'],
                                'indexes' => [
                                    static::CONTAINER_TYPE_STATIC_NAME,
                                    static::FIELD_PRICE_NAME,
                                    static::FIELD_PRICE_TYPE_NAME,
                                    static::FIELD_SKU_NAME,
                                    static::FIELD_MAX_CHARACTERS_NAME
                                ]
                            ],
                            'file' => [
                                'values' => ['file'],
                                'indexes' => [
                                    static::CONTAINER_TYPE_STATIC_NAME,
                                    static::FIELD_PRICE_NAME,
                                    static::FIELD_PRICE_TYPE_NAME,
                                    static::FIELD_SKU_NAME,
                                    static::FIELD_FILE_EXTENSION_NAME,
                                    static::FIELD_IMAGE_SIZE_X_NAME,
                                    static::FIELD_IMAGE_SIZE_Y_NAME
                                ]
                            ],
                            'select' => [
                                'values' => ['drop_down', 'radio', 'checkbox', 'multiple','thumb_gallery', 'thumb_gallery_popup', 'thumb_gallery_multi'],
                                'indexes' => [
                                    static::GRID_TYPE_SELECT_NAME
                                ]
                            ],
                            'data' => [
                                'values' => ['date', 'date_time', 'time'],
                                'indexes' => [
                                    static::CONTAINER_TYPE_STATIC_NAME,
                                    static::FIELD_PRICE_NAME,
                                    static::FIELD_PRICE_TYPE_NAME,
                                    static::FIELD_SKU_NAME
                                ]
                            ]
                        ],
                    ],
                ],
            ],
        ];
    }
}