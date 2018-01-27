<?php

namespace Apiworks\HiddenPrice\Plugin\Pricing;

use Magento\Framework\Pricing\Render;
use Magento\Framework\Pricing\SaleableInterface;

class RenderPlugin
{
    protected $helper;

    public function __construct(\Apiworks\HiddenPrice\Helper\Data $helper)
    {
        $this->helper = $helper;
    }

    public function aroundRender(Render $subject, callable $proceed, $priceCode, SaleableInterface $saleableItem, array $arguments = [])
    {
        $customPriceHtml = $this->helper->getCustomPriceHtml();
        if (false !== $customPriceHtml) {
            return $this->_checkAndRenderPrice($priceCode, $customPriceHtml);
        }
        //return $this->_checkRenderPrice($priceCode);
        //Check the settings and render accordingly ...
        return $proceed($priceCode, $saleableItem, $arguments);
    }

    protected function _checkAndRenderPrice($priceCode, $customPriceHtml)
    {
        if ($priceCode == 'final_price') {
            return $customPriceHtml;
        } else {
            return '';
        }
    }
}