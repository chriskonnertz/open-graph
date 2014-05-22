# Open Graph Builder

[![Build Status](https://travis-ci.org/chriskonnertz/open-graph.png)](https://travis-ci.org/chriskonnertz/open-graph)

Laravel 4 class that assists in building Open Graph meta tags.

## Installation

Add `chriskonnertz/open-graph` to `composer.json`:

    "chriskonnertz/open-graph": "dev-master"

Run `composer update` to get the latest version of Open Graph Builder.

Add the alias to `app/config/app.php`:
```php
    'aliases' => array(
        // ...
        'OpenGraph' => 'ChrisKonnertz\\OpenGraph\\OpenGraph',
    )
```

## Introduction

Example:
```php
    $og = new OpenGraph();

    $og->title('Apple Cookie')
        ->type('article')
        ->image('http://example.org/apple.jpg')
        ->description('Welcome to the best apple cookie recipe never created.')
        ->url();
```
Render these tags in a template as follows:
```
    {{ $og->renderTags() }}
```
Providing Open Graph tags enriches web pages. The downside is some extra time to spend, because every model has its own way to generate these tags. It's also important to follow the [official protocol](http://ogp.me/). Read the documentation to learn more about the tags that are available and the values they support or [check out examples](https://github.com/niallkennedy/open-graph-protocol-examples). Please note that this implementation sticks to the specification of OGP.me and does not support the enhancements created by Facebook.

## Add Tags And Attributes

### Add Basic Tags
```php
    $og->title('Apple Cookie')
        ->type('article')
        ->description('A delicious recipe')
        ->url()
        ->locale('en_US')
        ->localeAlternate(['en_UK'])
        ->siteName('Cookie Recipes Website')
        ->determiner('an');
```
> If no argument is passed to the `url` method the current URL is applied.

### Add Tags With Attributes

You may add `image`, `audio` or `video` tags and pass the basic value (the URL to the object) and an array of additional attributes.
```php
    $og->image($imageUrl, [
            'width'     => 300,
            'height'    => 200
        ]);

    $og->audio($audioUrl, [
            'type'     => 'audio/mpeg'
        ]);

    $og->video($videoUrl, [
            'width'     => 300,
            'height'    => 200,
            'type'      => 'application/x-shockwave-flash'
        ]);
```
### Add Type Attributes

Some object types (determined by the `type` tag) have their own tags with attributes but not a basic tag. These are `article`, `book` and `profile`.
```php
    $og->article([
        'author'        => 'Jane Doe'
    ]);

    $og->book([
        'author'        => 'John Doe'
    ]);

    $og->profile([
        'first_name'    => 'Kim'
        'last_name'     => 'Doe'
    ]);
```
### Add Attributes

Facebook supports more than just the basic object types. To add attributes for off-the-record object types you may use the `attributes` method.

Without custom validation rule:
```php
    $og->attributes('product', ['product:color' => 'red']);
```
With custom validation rule:
```php
    $og->attributes('product', ['product:color' => 'red'], ['product:color']);
```
The only validation this method performs is to check if all attribute names match with the list of attribute names.

### Add A Tag Several Times

A property can have multiple values. Add the tag several times to achieve this effect.
```php
    $og->image('http://example.org/apple.jpg')
        ->image('http://example.org/tree.jpg');
```
> Adding a basic tag a second time will override the value of the first tag. Basic tags must not exist several times.

## Validation

If validation is enabled (default is disabled) adding tags will trigger validation. Validation is not covering the complete specification but some important parts. If validation fails the method will throw an exception.

Validation checks if tag values are legit and if attribute types are known.

Enable validation by method:
```php
    $og->validate();
```
By constructor:
```php
    $og = new OpenGraph(true);
```
Disable validation:
```php
    $og->validate(false);
```
## Miscellaneous

### Determine If A Tag Exists
```php
    $hasTitle = $og->has('title');
```
### Remove A Tag From The List
```php
    $og->forget('title');
```
### Remove All Tags From The List
```php
    $og->clear();
```
### Add A Custom Tag
```php
    $og->tag('apples', 7);
```
### Get The Last Tag (By Name)
```php
    $tag = $og->lastTag('image');
    $value = $tag['value'];
```
> Tags are stored as arrays consisting of name-value-pairs.
