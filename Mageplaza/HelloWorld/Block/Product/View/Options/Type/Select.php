<?php
/**
 * Created by PhpStorm.
 * User: claretyoung
 * Date: 02/02/2018
 * Time: 11:46
 */

namespace Mageplaza\HelloWorld\Block\Product\View\Options\Type;



class Select extends \Magento\Catalog\Block\Product\View\Options\Type\Select
{
    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getValuesHtml()
    {
        $_option = $this->getOption();
        $configValue = $this->getProduct()->getPreconfiguredValues()->getData('options/' . $_option->getId());
        $store = $this->getProduct()->getStore();

        $this->setSkipJsReloadPrice(1);
        // Remove inline prototype onclick and onchange events

        if ($_option->getType() == \Magento\Catalog\Api\Data\ProductCustomOptionInterface::OPTION_TYPE_DROP_DOWN ||
            $_option->getType() == \Magento\Catalog\Api\Data\ProductCustomOptionInterface::OPTION_TYPE_MULTIPLE
        ) {
            $require = $_option->getIsRequire() ? ' required' : '';
            $extraParams = '';
            $select = $this->getLayout()->createBlock(
                \Magento\Framework\View\Element\Html\Select::class
            )->setData(
                [
                    'id' => 'select_' . $_option->getId(),
                    'class' => $require . ' product-custom-option admin__control-select'
                ]
            );
            if ($_option->getType() == \Magento\Catalog\Api\Data\ProductCustomOptionInterface::OPTION_TYPE_DROP_DOWN) {
                $select->setName('options[' . $_option->getId() . ']')->addOption('', __('-- Please Select --'));
            } else {
                $select->setName('options[' . $_option->getId() . '][]');
                $select->setClass('multiselect admin__control-multiselect' . $require . ' product-custom-option');
            }


            foreach ($_option->getValues() as $_value) {
                $priceStr = $this->_formatPrice(
                    [
                        'is_percent' => $_value->getPriceType() == 'percent',
                        'pricing_value' => $_value->getPrice($_value->getPriceType() == 'percent'),
                    ],
                    false
                );


                if ($_value->getDisplayMode() == 'image'){
                    $select->addOption(
                        $_value->getOptionTypeId(),
                        $_value->getTitle() . ' ' . strip_tags($priceStr) . '',
                        ['price'    => $this->pricingHelper->currencyByStore($_value->getPrice(true), $store, false),
                            'data-src' => 'image||' . $this->_storeManager->getStore()->getBaseUrl().'pub/media/'.$_value->getImageName()
                        ]
                    );
                }
                else{
                    $select->addOption(
                        $_value->getOptionTypeId(),
                        $_value->getTitle() . ' ' . strip_tags($priceStr) . '',
                        ['price'    => $this->pricingHelper->currencyByStore($_value->getPrice(true), $store, false),
                            'data-src' => 'color||'.$_value->getColor()
                        ]
                    );
                }

            }

            if ($_option->getType() == \Magento\Catalog\Api\Data\ProductCustomOptionInterface::OPTION_TYPE_MULTIPLE) {
                $extraParams = ' multiple="multiple"';
                $extraParams .= ' onchange="multiImageDisplay(this,'.$_option->getId().');" ';
            }
            else{
                $extraParams .= ' onchange="singleImageDisplay(this,'.$_option->getId().');" ';
            }
            if (!$this->getSkipJsReloadPrice()) {
                $extraParams .= ' onchange="opConfig.reloadPrice()"';
            }
            $extraParams .= ' data-selector="' . $select->getName() . '"';
            $select->setExtraParams($extraParams);

            if ($configValue) {
                $select->setValue($configValue);
            }

            return $select->getHtml();
        }

        if ($_option->getType() == \Magento\Catalog\Api\Data\ProductCustomOptionInterface::OPTION_TYPE_RADIO ||
            $_option->getType() == \Magento\Catalog\Api\Data\ProductCustomOptionInterface::OPTION_TYPE_CHECKBOX
        ) {
            $selectHtml = '<div class="options-list nested" id="options-' . $_option->getId() . '-list">';
            $require = $_option->getIsRequire() ? ' required' : '';
            $arraySign = '';
            switch ($_option->getType()) {
                case \Magento\Catalog\Api\Data\ProductCustomOptionInterface::OPTION_TYPE_RADIO:
                    $type = 'radio';
                    $class = 'radio admin__control-radio';
                    if (!$_option->getIsRequire()) {
                        $selectHtml .= '<div class="field choice admin__field admin__field-option">' .
                            '<input type="radio" id="options_' .
                            $_option->getId() .
                            '" class="' .
                            $class .
                            ' product-custom-option" name="options[' .
                            $_option->getId() .
                            ']"' .
                            ' data-selector="options[' . $_option->getId() . ']"' .
                            ($this->getSkipJsReloadPrice() ? '' : ' onclick="opConfig.reloadPrice()"') .
                            ' value="" checked="checked" /><label class="label admin__field-label" for="options_' .
                            $_option->getId() .
                            '"><span>' .
                            __('None') . '</span></label></div>';
                    }
                    break;
                case \Magento\Catalog\Api\Data\ProductCustomOptionInterface::OPTION_TYPE_CHECKBOX:
                    $type = 'checkbox';
                    $class = 'checkbox admin__control-checkbox';
                    $arraySign = '[]';
                    break;
            }
            $count = 1;
            foreach ($_option->getValues() as $_value) {
                $count++;

                $priceStr = $this->_formatPrice(
                    [
                        'is_percent' => $_value->getPriceType() == 'percent',
                        'pricing_value' => $_value->getPrice($_value->getPriceType() == 'percent'),
                    ]
                );

                $htmlValue = $_value->getOptionTypeId();
                if ($arraySign) {
                    $checked = is_array($configValue) && in_array($htmlValue, $configValue) ? 'checked' : '';
                } else {
                    $checked = $configValue == $htmlValue ? 'checked' : '';
                }

                $dataSelector = 'options[' . $_option->getId() . ']';
                if ($arraySign) {
                    $dataSelector .= '[' . $htmlValue . ']';
                }

                $selectHtml .= '<div class="field choice admin__field admin__field-option' .
                    $require .
                    '">' .
                    '<input style="margin: 15px" type="' .
                    $type .
                    '" class="' .
                    $class .
                    ' ' .
                    $require .
                    ' product-custom-option"' .
                    ($this->getSkipJsReloadPrice() ? '' : ' onclick="opConfig.reloadPrice()"') .
                    ' name="options[' .
                    $_option->getId() .
                    ']' .
                    $arraySign .
                    '" id="options_' .
                    $_option->getId() .
                    '_' .
                    $count .
                    '" value="' .
                    $htmlValue .
                    '" ' .
                    $checked .
                    ' data-selector="' . $dataSelector . '"' .
                    ' price="' .
                    $this->pricingHelper->currencyByStore($_value->getPrice(true), $store, false) .
                    '" />' .
                    '<label  style="margin: 15px" class="label admin__field-label" for="options_' .
                    $_option->getId() .
                    '_' .
                    $count .
                    '"><span style="margin: 15px">' .
                    $_value->getTitle() .
                    '</span> ' .
                    $priceStr .
                    $this->getImageColorDisplayMOde($_value->getDisplayMode(), $_value->getImageName() ,$_value->getColor() ).
                    '</label>';
                $selectHtml .= '</div>';
            }
            $selectHtml .= '</div>';

            return $selectHtml;
        }
    }

    public function getImageColorDisplayMOde($display_mode, $image, $color){
        $mode = '';
        $imgUrl = $this->_storeManager->getStore()->getBaseUrl().'pub/media/'.$image;

        if($display_mode == 'color'){
            $mode .= '<div' .
                ' style="background-color:'.$color.'; ' .
                'width: 40px; height: 40px; float: right;"></div>';
        }
        else if($display_mode == 'image'){
            $mode .= '<img src="'.$imgUrl.'" style=" width: 40px; height: 40px; float: right;" >';
        }else{
            $mode .= '<div' .
                ' style="background-color:white; ' .
                'width: 40px; height: 40px; float: right;"></div>';
        }
        return $mode;
    }


}