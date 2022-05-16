# Minimal PHP Request Router

Every professional web developer knows handling request routing can be a pain in the ***.
I sometimes **wished** there could be an excessively lightweight library which handles request routing. So I wasn't forced to load Laravel or even Lumen to to so.
This repository contains my solution for my own problem but I think others will find it useful too.

## Installation

```shell
composer require underdash/router
```

## Using Closures

```php
use Underdash\Router;

Router::get('/', function() {
  return "Welcome to my blog!";
});

Router::dispatch();
```

## Using Controllers

```php
use Underdash\Router;

class PagesController {
    public static function index(){
        return "Welcome from controller!";
    }
}

Router::get('/', 'PagesController@index');

Router::dispatch();
```

## Minimal Wildcard Support

```php
use Underdash\Router;

Router::get('/user/{name}', function($name) {
  return "You are probably {$name}, and I know it!";
});

Router::dispatch();
```