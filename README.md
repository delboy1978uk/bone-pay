# bone-pay
Payment gateway package for Bone Framework
## installation
Use Composer
```
composer require delboy1978uk/bone-pay
```
## usage
Simply add to the `config/packages.php`
```php
<?php

// use statements here
use Bone\Pay\PayPackage;

return [
    'packages' => [
        // packages here...,
        PayPackage::class,
    ],
    // ...
];
```
Configure your payment adapters in `config/bone-pay.php`
```php
return [
    'bone-pay' => [
        'adapters' => [
            'Paypal' => [
                
            ],
        ],
    ],
];
```