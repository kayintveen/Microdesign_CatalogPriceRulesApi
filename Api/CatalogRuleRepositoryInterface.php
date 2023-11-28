<?php

namespace Microdesign\CatalogPriceRulesApi\Api;

use \Magento\Framework\Api\SearchCriteriaInterface;

interface CatalogRuleRepositoryInterface
{

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

}
