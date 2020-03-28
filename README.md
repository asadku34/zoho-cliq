# Laravel Helper Package For Zoho Cliq

[![Latest Version on Packagist](https://img.shields.io/packagist/v/asad/zoho-cliq.svg?style=flat-square)](https://packagist.org/packages/asad/zoho-cliq)
[![Build Status](https://img.shields.io/travis/asad/zoho-cliq/master.svg?style=flat-square)](https://travis-ci.org/asad/zoho-cliq)
[![Quality Score](https://img.shields.io/scrutinizer/g/asad/zoho-cliq.svg?style=flat-square)](https://scrutinizer-ci.com/g/asad/zoho-cliq)
[![Total Downloads](https://img.shields.io/packagist/dt/asad/zoho-cliq.svg?style=flat-square)](https://packagist.org/packages/asad/zoho-cliq)
[![License](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/asad/zoho-cliq)

This is a simple laravel package for [Zoho Cliq](https://www.zoho.com/cliq/help/restapi/v2/#Messages). It's use token base authentication. So, you will get only message api helper method from this package.

## Installation

You can install the package via composer:

```bash
composer require asad/zoho-cliq
```

## Config

After executing the following command you will get zcliq.php file under config directory. Set Authtoken, Channel Name, Send to(Channel, Chat, Bot, User) in the config file.

```bash
php artisan vendor:publish --provider="Asad\ZohoCliq\ZohoCliqServiceProvider"
```

## Usage

```php
use Asad\ZohoCliq\ZCliq;

// Inside method
ZCliq::to('channel_name')->card([
            'title' => 'ANNOUNCEMENT',
            'theme' => 'modern-inline',
            'thumbnail' => 'https://www.zoho.com/cliq/help/restapi/images/announce_icon.png'
        ])->send("Send Message to Cliq Channel using asad/zoho-cliq package");

//Without Card
ZCliq::to('channel_name')->send("Send Message to Cliq Channel using asad/zoho-cliq package");

```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email asadku34@gmail.com instead of using the issue tracker.

## Credits

-   [Asadur Rahman](https://github.com/asad)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
