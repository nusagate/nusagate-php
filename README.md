# Nusagate API Client - PHP

The official PHP library for the Nusagate API.

Visit https://nusagate.com.

## 1. Documentation

For more details visit [Nusagate API docs](https://nusagate.docs.apiary.io/#).

You can see example [here](examples/).

## 2. Installation

```sh
composer require nusagate/nusagate-php
```

## 3. Usage

Get your api key and secret key from [Nusagate Dashboard](https://dashboard.nusagate.com/).

```php
// params : is_production, api_key, secret_key
$nusagate = new Nusagate(true, 'YOUR_API_KEY','YOUR_SECRET_KEY');
```
