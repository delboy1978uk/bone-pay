# pay
Pay package for Bone Mvc Framework
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