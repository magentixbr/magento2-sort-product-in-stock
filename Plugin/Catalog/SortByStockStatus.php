<?php

namespace Magentix\ProductInStock\Plugin\Catalog;

class SortByStockStatus
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * SortByStockStatus constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Sort items that are not salable last
     *
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function afterGetProductCollection(
        \Magento\Catalog\Model\Layer $subject,
        \Magento\Catalog\Model\ResourceModel\Product\Collection $collection
    ) {
        if ($this->scopeConfig->getValue(
            'cataloginventory/debug/template_hints',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        )) {
            $collection->getSelect()->order('stock_status DESC');
        }
        return $collection;
    }
}
