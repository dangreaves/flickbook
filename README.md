#Flickbook

[![Build Status](https://travis-ci.org/dangreaves/flickbook.svg)](https://travis-ci.org/dangreaves/flickbook)

An experiment in utilising the Flickr API without a third party abstraction library.

##Getting started

1. PHP 5.3.x is required
2. Install Flickbook dependencies using `composer install`
3. Setup URL rewriting so that all requests are handled by `public/index.php`
4. Copy `config/config.php.dist` to `config/config.php` and enter your Flickr API credentials

##Todo

- [ ] Add unit tests and setup with Travis CI
- [ ] Handle Flickr HTTP exceptions
- [x] Handle Flickr API exceptions