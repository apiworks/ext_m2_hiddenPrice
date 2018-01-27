<?php

namespace Apiworks\HiddenPrice\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
{
    const HIDDENPRICE_LOGIN_ENABLED = 'hidden_price/login_for_price/enabled';
    const HIDDENPRICE_LOGIN_MESSAGE_TYPE = 'hidden_price/login_for_price/message_type';
    const HIDDENPRICE_LOGIN_MESSAGE_TEXT = 'hidden_price/login_for_price/message_text';
    const HIDDENPRICE_LOGIN_MESSAGE_CMS_BLOCK = 'hidden_price/login_for_price/message_static_block';


    protected $customerSession;

    public function __construct(Context $context, \Magento\Customer\Model\Session $customerSession)
    {
        $this->customerSession = $customerSession;
        parent::__construct($context);
    }

    public function isLoginForPriceEnabled()
    {
        return $this->scopeConfig->isSetFlag(self::HIDDENPRICE_LOGIN_ENABLED);
    }

    public function isCustomerLoggedIn()
    {
        return $this->customerSession->isLoggedIn();
    }

    public function getCustomPriceHtml()
    {
        //TODO: Add setting for custom text/block to display in place of price
        if ($this->isLoginForPriceEnabled() AND !$this->isCustomerLoggedIn()) {
            return 'customblock';
        }

        return false;
    }

    public function isAddToCartDisabled()
    {
        if ($this->isLoginForPriceEnabled() AND !$this->isCustomerLoggedIn()) {
            return true;
        }

        return false;
    }

    public function getLoggedInMessageType()
    {
        return $this->scopeConfig->getValue(self::HIDDENPRICE_LOGIN_MESSAGE_TYPE);
    }

    public function getLoggedInMessageText()
    {
        return $this->scopeConfig->getValue(self::HIDDENPRICE_LOGIN_MESSAGE_TEXT);
    }

    public function getLoggedInMessageCmsBlock()
    {
        return $this->scopeConfig->getValue(self::HIDDENPRICE_LOGIN_MESSAGE_CMS_BLOCK);
    }

    public function getLoggedInCustomMessageHtml()
    {
        $messageType = $this->getLoggedInMessageType();
        if ($messageType == 'cms_block') {
            $block = $this->getLoggedInMessageCmsBlock();
            //TODO: Render block

        } else {
            $text = $this->getLoggedInMessageText();
            //TODO: Render
        }
    }


}