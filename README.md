# Omnipay: Moneris

**Moneris driver for the Omnipay PHP payment processing library**

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Moneris support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "anilahir/omnipay-moneris": "^2.*"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following gateways are provided by this package:

* Moneris

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/anilahir/omnipay-moneris/issues),
or better yet, fork the library and submit a pull request.

[ico-version]: https://img.shields.io/packagist/v/anilahir/omnipay-moneris.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/anilahir/omnipay-moneris/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/anilahir/omnipay-moneris.svg?style=flat-square
[ico-coverage-status]: https://coveralls.io/repos/github/anilahir/omnipay-moneris/badge.svg?branch=master
[ico-code-quality]: https://img.shields.io/scrutinizer/g/anilahir/omnipay-moneris.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/anilahir/omnipay-moneris.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/anilahir/omnipay-moneris
[link-travis]: https://travis-ci.org/anilahir/omnipay-moneris
[link-scrutinizer]: https://scrutinizer-ci.com/g/anilahir/omnipay-moneris/code-structure
[link-coverage-status]: https://coveralls.io/github/anilahir/omnipay-moneris?branch=master
[link-code-quality]: https://scrutinizer-ci.com/g/anilahir/omnipay-moneris
[link-downloads]: https://packagist.org/packages/anilahir/omnipay-moneris
