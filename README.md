# "A package that ensures compatibility between the 'withWhereHas' method and the 'withAggregate' methods."

[![Latest Version on Packagist](https://img.shields.io/packagist/v/muratgorken/laravel-with-where-has-aggregate.svg?style=flat-square)](https://packagist.org/packages/muratgorken/laravel-with-where-has-aggregate)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/muratgorken/laravel-with-where-has-aggregate/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/muratgorken/laravel-with-where-has-aggregate/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/muratgorken/laravel-with-where-has-aggregate/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/muratgorken/laravel-with-where-has-aggregate/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/muratgorken/laravel-with-where-has-aggregate.svg?style=flat-square)](https://packagist.org/packages/muratgorken/laravel-with-where-has-aggregate)


## Installation

You can install the package via composer:

```bash
composer require muratgorken/laravel-with-where-has-aggregate
```

## Usage
For example, from an author model, we want to rank authors who have books in the drama category and authors based on the average page count of those books. And we want to do this bootstrapped.
So;
```php
$authorsWithDramaBooks = Author::withWhereHasAggregate('books', function ($query) {
			$query->where('type', 'drama');
		}, 'avg(page_count as page_avg)')->get();
```
in the form of $query->where.

This package also supports multiple operations.
```php
$authorsWithRomanticBooks = Author::withWhereHasAggregate('books', function ($query) {
			$query->where('type', 'romantic');
		}, 'avg(page_count as page_avg', 'max(page_count) as page_max', 'min(page_count) as page_min')->get()->toArray();
```
output of the above query;
```php
array:1 [▼
  0 => array:6 [▼
    "id" => 1
    "name" => "William Shakespeare"
    "page_avg" => "400.0000"
    "page_max" => 500
    "page_min" => 300
    "books" => array:2 [▼
      0 => array:5 [▼
        "id" => 1
        "name" => "Romeo and Juliet"
        "author_id" => 1
        "type" => "romantic"
        "page_count" => 500
      ]
      1 => array:5 [▼
        "id" => 2
        "name" => "Measure for Measure"
        "author_id" => 1
        "type" => "romantic"
        "page_count" => 300
      ]
    ]
  ]
]
```
this way you can run multiple aggregate functions withWhereHas. 

When used withWhereHas withAggregate methods in Laravel itself, it does not run the relevant conditions in withAggregate methods even though it is the same relation. This means that if you; similar to the example above
```php
$books = Author::whereHas('books', function ($query) {
    $query->where('type', 'drama');
})->withAvg('books as page_count_avg', 'page_count')->get();
```
it will calculate the average page count of all books, not just books of the drama type.

feel free to ask if you have any questions.

```php
$books = Author::whereHas('books', function ($query) {
    $query->where('type', 'drama');
})->withAggregate('books as page_count_avg', 'page_count', 'avg', function($query) {
    $query->where('type', 'drama');
})->get();
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Murat Görken](https://github.com/muratgorken)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
