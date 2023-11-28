<?php

namespace Microdesign\CatalogPriceRulesApi\Plugin;

use Magento\CatalogRule\Api\Data\RuleExtensionFactory;
use Magento\CatalogRule\Api\Data\RuleExtensionInterface;
use Magento\CatalogRule\Api\Data\RuleInterface;
use Magento\CatalogRule\Api\CatalogRuleRepositoryInterface;

/**
 * Class CatalogRuleRepositoryPlugin
 */
class CatalogRuleRepositoryPlugin
{

    /**
     * Rule Extension Attributes Factory
     *
     * @var RuleExtensionFactory
     */
    protected $extensionFactory;

    /**
     * CatalogRuleRepositoryPlugin constructor
     *
     * @param RuleExtensionFactory $extensionFactory
     */
    public function __construct(RuleExtensionFactory $extensionFactory)
    {
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * @param CatalogRuleRepositoryInterface $subject
     * @param RuleInterface                  $rule
     *
     * @return RuleInterface
     */
    public function afterGet(CatalogRuleRepositoryInterface $subject, RuleInterface $rule)
    {
        $websiteIds          = $rule->getData('website_ids');
        $customerGroupIds    = $rule->getCustomerGroupIds();
        $extensionAttributes = $rule->getExtensionAttributes();
        $extensionAttributes = $extensionAttributes ? $extensionAttributes : $this->extensionFactory->create();
        $extensionAttributes->setWebsiteIds($websiteIds);
        $extensionAttributes->setCustomerGroupIds($customerGroupIds);
        $rule->setExtensionAttributes($extensionAttributes);

        return $rule;
    }

    /**
     * @param CatalogRuleRepositoryInterface $subject
     * @param RuleInterface                  $rule
     *
     * @return array
     */
    public function beforeSave(CatalogRuleRepositoryInterface $subject, RuleInterface $rule)
    {
        $extensionAttributes = $rule->getExtensionAttributes() ?: $this->extensionFactory->create();
        if ($extensionAttributes !== null && $extensionAttributes->getWebsiteIds() !== null) {
            $rule->setWebsiteIds($extensionAttributes->getWebsiteIds());
        }
        if ($extensionAttributes !== null && $extensionAttributes->getCustomerGroupIds() !== null) {
            $rule->setCustomerGroupIds($extensionAttributes->getCustomerGroupIds());
        }

        return [$rule];
    }
}
