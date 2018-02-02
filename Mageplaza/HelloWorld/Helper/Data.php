<?php

namespace Mageplaza\HelloWorld\Helper;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Data extends AbstractHelper
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterfac
     */
    protected $_scopeConfig;

    CONST IMAGE_SIZE      = 'image_option/general/image_size';
    CONST IMAGE_HEIGHT = 'image_option/general/image_height';
    CONST IMAGE_WIDTH  = 'image_option/general/image_width';

    public function __construct(
       Context $context,
       ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);

        $this->_scopeConfig = $scopeConfig;
    }

    public function getImageSize(){
        return $this->_scopeConfig->getValue(self::IMAGE_SIZE);
    }

    public function getImageHeight(){
        return $this->_scopeConfig->getValue(self::IMAGE_HEIGHT);
    }

    public function getIMageWidth(){
        return $this->_scopeConfig->getValue(self::IMAGE_WIDTH);
    }
}

