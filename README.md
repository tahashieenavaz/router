# Minimal PHP Request Router

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