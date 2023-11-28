# Magento 2 module for Catalog Price rules REST api endpoints

Currently in Magento 2 it is not able to create, update, list or delete Catlog Price rules through Magento's own REST api.
This module adds these endpoints to the REST api.

- X.com / Twitter: [@kayintveen](https://x.com/kayintveen)
- Website: [microdesign.nl](https://microdesign.nl)

## Installation

```bash
composer require microdesign/catalogpricerulesapi
php bin/magento module:enable Microdesign_CatalogPriceRulesApi
php bin/magento setup:upgrade
```

## Usage

To create a price rule use for example this POST endpoint

{{magento_api_url}}/V1/catalogRules/


```php
  {
    "rule": {
      "name": "sample price rule",
      "description": "rule as example",
      "is_active": 1,
      "rule_condition": {
        "type": "Magento\\CatalogRule\\Model\\Rule\\Condition\\Combine",
        "attribute": "",
        "operator": "",
        "value": "1",
        "is_value_parsed": false,
        "aggregator": "all",
        "conditions": [
          {
            "type": "Magento\\CatalogRule\\Model\\Rule\\Condition\\Product",
            "attribute": "category_ids",
            "operator": "()",
            "value": "27",
            "is_value_parsed": false,
            "aggregator": ""
          }
        ]
      },
      "stop_rules_processing": 1,
      "sort_order": 0,
      "simple_action": "by_percent",
      "discount_amount": 15,
      "extension_attributes": {
          "website_ids": [0],
          "customer_group_ids": [0,2]
      }
    }
  }

```

GET a specifi rule
{{magento_api_url}}/V1/catalogRules/3

or search / list the rules
`{{magento_api_url}}/V1/catalogRules/search?searchCriteria[filter_groups][0][filters][0][field]=rule_id&searchCriteria[filter_groups][0][filters][0][value]=1&searchCriteria[filter_groups][0][filters][0][condition_type]=eq&searchCriteria[pageSize]=10`

