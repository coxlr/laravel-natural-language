# A Laravel package for the Google Natural language API

[![Latest Version](https://img.shields.io/github/release/coxlr/laravel-natural-language.svg?style=flat-rounded)](https://github.com/coxlr/laravel-natural-language/releases)
[![Tests](https://github.com/coxlr/laravel-natural-language/actions/workflows/run-tests.yml/badge.svg)](https://github.com/coxlr/laravel-natural-language/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/coxlr/laravel-natural-language.svg?style=flat-rounded&colorB=brightgreen)](https://packagist.org/packages/coxlr/laravel-natural-language)

This package makes using the Google Natural API in your laravel app a breeze with minimum to no configuration, clean syntax and a consistent package API. All methods accept a string and return an array: [Docs below.](https://github.com/Coxlr/laravel-natural-language/#how-to-use)

It builds upon [JoggApp/laravel-natural-language](https://github.com/JoggApp/laravel-natural-language), a package initially developed by [Harish Toshniwal](https://github.com/introwit) which is no longer activly maintained.

![natural](https://user-images.githubusercontent.com/11228182/46806140-765d4000-cd84-11e8-9d88-e71338d53376.png)

## Installation

This package requires PHP 8.1 and Laravel 10 or higher.

You can install this package via composer using this command:

```bash
composer require coxlr/laravel-natural-language
```

- The package will automatically register itself.

- You can find documentation on how to set up the project and get the necessary configurations from the Google Cloud Platform console in a step by step detailed manner [here.](https://github.com/Coxlr/laravel-natural-language/blob/master/google.md)

- You can publish the config file using the following command:

```bash
php artisan vendor:publish --provider="Coxlr\NaturalLanguage\NaturalLanguageServiceProvider"
```

This will create the package's config file called `naturallanguage.php` in the `config` directory. These are the contents of the published config file:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | The id of project created in the Google Cloud Platform console.
    |--------------------------------------------------------------------------
    */
    'project_id' => env('NATURAL_LANGUAGE_PROJECT_ID', 'sample-12345'),

    /*
    |--------------------------------------------------------------------------
    | Path to the json file containing the authentication credentials.
    |--------------------------------------------------------------------------
    */
    'key_file_path' => base_path('composer.json'),
];
```

## Usage

After setting up the config file values you are all set to use the following methods:

- Detect the Sentiment: Accepts a string and returns an array.

```php
NaturalLanguage::sentiment(string $text): array
```

- Detect the Entities: Accepts a string and returns an array.

```php
NaturalLanguage::entities(string $text): array
```

- Detect the Sentiment per-entity basis: Accepts a string and returns an array.

```php
NaturalLanguage::entitySentiment(string $text): array
```

- Detect the syntax: Accepts a string and returns an array.

```php
NaturalLanguage::syntax(string $text): array
```

- Detect the categories: Accepts a string and returns an array.

```php
NaturalLanguage::categories(string $text): array
```

- Annotate text: Accepts a string and an optional `features` array & returns an array.

```php
NaturalLanguage::annotateText(string $text, array $features = ['sentiment', 'syntax']): array
```

## Testing

You can run the tests with:

```bash
composer test
```

## Changelog

Please see the [CHANGELOG](CHANGELOG.md) for more information about what has changed recently.

## Security

If you discover any security related issues, please email them to [hello@leecox.dev](mailto:hello@leecox.dev) instead of using the issue tracker.

## Credits
- [Lee Cox](https://github.com/coxlr)
- [Harish Toshniwal](https://github.com/introwit)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see the [License File](LICENSE.txt) for more information.
