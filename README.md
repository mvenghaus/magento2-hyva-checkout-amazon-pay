
# hyva-checkout-amazon-pay
Hyvä Compatibility module for Amazon_Pay

## Requirements

```
"php": "^8.2.0",
"hyva-themes/magento2-default-theme": "^1.2.0",
"hyva-themes/magento2-hyva-checkout": "^1.0.2",
```

## Link to original module
https://github.com/amzn/amazon-payments-magento-2-plugin

## Features to be implemented
- [x] Credentials
    - [x] Amazon Pay (Enabled)
    - [x] Public Key ID
    - [x] Merchant Id
    - [x] Store Id
    - [x] Payment Region
    - [x] Sandbox
- [x] Options
    - [x] Multi-currency Functionality
    - [x] Amazon Sign-in (partial, only during checkout)
    - [x] Payment
    - [x] Authorization Mode
- [ ] Alexa Delivery Notifications
    - [ ] Alexa Delivery Notifications <span style="color:#666">(not tested, maybe it will work)</span>
- [x] Advanced
  - [ ] Frontend
      - [x] Button Display Language
      - [x] Button Color
      - [ ] Amazon Pay button on product page
      - [x] Amazon Pay button in minicart
      - [ ] Amazon Pay in final checkout step
  - [ ] Sales Options
      - [ ] Store Name <span style="color:#666">(not tested, maybe it will work)</span>
      - [ ] Restrict Product Categories <span style="color:#666">(not tested, maybe it will work)</span>
  - [ ] Shipping Restrictions
      - [ ] Restrict Post Office Boxes <span style="color:#666">(not tested, maybe it will work)</span>
      - [ ] Restrict Packstations <span style="color:#666">(not tested, maybe it will work)</span>
  - [x] Developer Options
    - [x] Logging
    - [x] Amazon checkout review return URL
    - [x] Magento Checkout URL Path
    - [x] Amazon checkout result return URL
    - [x] Sign In result URL Path
    - [x] Magento Checkout result URL Path
    - [x] Amazon Checkout cancel URL Path
    - [x] Amazon Sign In cancel URL Path
    - [x] Allowed IPs

## Additional Features

### Pay Button Renderer ViewModel

You can use the `AmazonPayRendererViewModel` to render the Pay Button wherever you want.

```
...
$amazonPayRendererViewModel = $viewModels->require(\Hyva\AmazonPay\ViewModel\AmazonPayRendererViewModel::class);
...
<?= $amazonPayRendererViewModel->renderPayButton() ?>
...
```

### Additional Script Attributes (GDPR Compliance)

The offical Amazon Pay module makes it very difficult to only load when the user has accepted.

There is a new config setting to make this a little bit easier:

`Store Configuration > Sales > Payment Methods > Amazon Pay > Advanced > Hvva Checkout > Script Attributes`

Here you can define a JSON string to add additional attributes to the initial script tag.

Example:
```
{
  "type": "text/plain",
  "cmdVendor": "123"
}
```

## Installation

### Via packagist.com

Hyvä Compatibility modules that are tagged as stable can be installed using composer via packagist.com:

1. Install via composer
    ```
    composer require hyva-themes/hyva-checkout-amazon-pay:dev-dev
    ```
2. Enable module
    ```
    bin/magento setup:upgrade
    ```


### Via gitlab

For development of or to contribute to this module, it needs to be installed using composer via gitlab.  
This installation method is not suited for deployments, because gitlab requires SSH key authorization.

1. Install via composer
    If this is the first time a compatibility module is installed via gitlab, the compat-module-fallback git repository has to be added as a
    composer repository. This step is only required once.
    ```
    composer config repositories.hyva-themes/magento2-compat-module-fallback git git@gitlab.hyva.io:hyva-themes/magento2-compat-module-fallback.git
    ```

    When the compat-module-fallback repo is configured, the compatibility module itself can be installed with composer:
    ```
    composer config repositories.hyva-themes/hyva-checkout-amazon-pay git git@gitlab.hyva.io:hyva-checkout/checkout-integrations/hyva-checkout-amazon-pay.git
    composer require hyva-themes/hyva-checkout-amazon-pay:dev-dev
    ```
2. Enable module
    ```
    bin/magento setup:upgrade
    ```
   
