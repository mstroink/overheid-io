<p align="center">
    <a href="https://travis-ci.com/mstroink/overheid-io" target="_blank">
        <img alt="Build Status" src="https://travis-ci.com/mstroink/overheid-io.svg?branch=master">
    </a>
    <a href="https://codecov.io/gh/mstroink/overheid-io" target="_blank">
        <img alt="Coverage Status" src="https://codecov.io/gh/mstroink/overheid-io/branch/master/graph/badge.svg">
    </a>
    <a href="https://packagist.org/packages/mstroink/overheid-io" target="_blank">
        <img alt="Stable" src="https://poser.pugx.org/mstroink/overheid-io/v/stable.svg">
    </a>
    <a href="https://php.net" target="_blank">
        <img alt="php Version" src="https://img.shields.io/badge/php-%3E=%207.2-8892BF.svg">
    </a>
</p>

# Simple PHP wrapper for Overheid.io
This package provides a simple client for consuming the OverheidIo Api.

The API documentation can be found on: https://overheid.io/documentatie. You can get an api-key here https://overheid.io/register

## Installing OverheidIo

The recommended way to install Overheid-Io is through [Composer](http://getcomposer.org).

```bash
composer require mstroink/overheid-io
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

## Usage
```php
use MStroink\OverheidIo\OverheidIoFactory;

$overheid = new OverheidIoFactory::create($apiKey);
```

Or use your own (authenticated) client. An adapter is required to be an implementation of \MStroink\OverheidIo\Http\HttpClientInterface

```php
use MStroink\OverheidIo\OverheidIo;

$overheid = new OverheidIo($client);
```

### Rdw API
```php
// Get car info by licence plate
try {
    $response = $overheid->rdw()->get('76-GP-LH');    
} catch(\MStroink\OverheidIo\Exception\NotFoundException $e) {
    var_dump($e->getMessage());
    var_dump($e->getCode());
    var_dump($e->getPrevious());
}

// Search
$rdw = $overheid->rdw();
$response = $rdw
    ->fields(['merk', 'voertuigsoort', 'kenteken', 'eerste_kleur'])
    ->query('*laren')
    ->queryFields(['merk'])
    ->search();
```

### Bag API
```php
// Get bag info by bag id
try {
    $response = $overheid->bag()->get('3015ba-nieuwe-binnenweg-10-a');   
} catch(\MStroink\OverheidIo\Exception\NotFoundException $e) {

}

// Search
$bag = $overheid->bag();
$response = $bag
    ->filters(['postcode' => '3015BA'])
    ->search();
```

### Kvk API
```php
// Get company info by kvk id
try {
    $response = $overheid->kvk()->get('hoofdvestiging-57842019-0000-van-der-lei-techniek-bv');
} catch(\MStroink\OverheidIo\Exception\NotFoundException $e) {

}

// Search
$response = $overheid->kvk()
    ->filters(['dossiernummer' => '52921506'])
    ->search();

// Suggest
$response = $overheid->kvk()
    ->fields(['handelsnaam'])
    ->limit(10)
    ->suggest('Valken');

```

## Filtering (All APIs)
```php
$rdw = $overheid->rdw();

// Number of items returned in the response
$rdw->limit(100);

// Specify the page of results to return
$rdw->page(1);

// Control whether results are returned in ascending or descending order
$rdw->order('asc'); $rdw->order('desc');

// To limit the fields fetched, you can use the fields() method
$rdw->fields(['voertuigsoort', 'kenteken', 'merk', 'eerstekleur']);

//Filter results by value
$rdw->filters(['merk' => 'dikke-bmw']);

// Query for car brand ending with laren
$rdw->query('*laren');

// Apply this query on the merk field
$rdw->queryFields(['merk']);

// Execute
$rdw->search();
```

## Run tests
```
vendor/bin/phpunit
```
