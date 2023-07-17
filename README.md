# yii2-salesmanago
Salesmanago component for Yii 2 framework

[SALESmanago Technical API Documentation](http://support.salesmanago.pl/wp-content/uploads/2014/10/SALESmanago-API-en.pdf)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Run

```
composer require "mrstroz/yii2-salesmanago" "*"
```

or add

```
"mrstroz/yii2-salesmanago": "*"
```

to the require section of your `composer.json` file.

Usage
-----

1. Add component to your config file
```php
'components' => [
    // ...
    'salesmanago' => [
        'class' => 'mrstroz\salesmanago\Salesmanago',
        'clientId' => 'xxxxxx',
        'apiKey' => 'xxxxxx',
        'apiSecret' => 'xxxxxx',
        'endpoint' => 'xxxxxx',
    ],
]
```

2. Add new contact to SALESmanago
```php
$salesmanago = Yii::$app->salesmanago;
$result = $salesmanago->call('contact/upsert',[
    contact' => [
        'email' => 'example@example.com',
        'state' => 'CUSTOMER',
    ],
    'owner' => 'owner@owner.com',
    'tags' => [
        'TAG'
    ],
    'properties' => array('page' => 'newsletter'),
    'lang' => 'PL',
    'useApiDoubleOptIn' => true,
    'forceOptIn' => true,
    'forceOptOut' => false,
    'forcePhoneOptIn' => true,
    'forcePhoneOptOut' => false
    ]
);
```

Check [SALESmanago Technical API Documentation](http://support.salesmanago.pl/wp-content/uploads/2014/10/SALESmanago-API-en.pdf) for all available options.
