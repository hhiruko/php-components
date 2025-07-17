# PHP Components

A proof-of-concept implementation of components for template rendering in PHP, inspired by JSX. You can write components as either functions or classes.

## Using Components:

You can use components in your view files:
```html
<div>
    <MyComponent />
</div>
```

You can pass props:
```html
<div>
    <MyComponent prop1="prop1" prop2="prop2" />
</div>
```

### Non-void components:

You can also pass an HTML string like this:
```html
<div>
    <MyComponent>This is a component with a closing tag.</MyComponent>
</div>
```

But first, you need to define components as functons or classes. You can make one component a function, and another a class.

## Functional components:

Define a component:
```php
function MyComponent() {
    return <<<HTML
        <div>This is a component.</div>
    HTML;
}
```

Passing props:
```php
function MyComponent(string $prop1, string $prop2 = '') {
    return <<<HTML
        <div>This is a component with props {$prop1} and {$prop2}.</div>
    HTML;
}
```

You can call components inside components:
```php
function NestedComponent() {
    return <<<HTML
        <div>This is a nested component: </div>
        <MyComponent />
    HTML;
}
```
You can nest any type of component inside any type of component.

### Non-void components:

The parameter `$innerHtml` is used to pass content between opening and closing tags:
```php
function MyComponent(string $innerHtml) {
    return <<<HTML
        <div>{$innerHtml}</div>
    HTML;
}
```

## Class components:

To use class components, you need to first `use` it in a View file or another component:
```php
<?php 

use App\components\MyClassComponent;

?>
```

Define a component:
```php
namespace App\components;

class MyClassComponent {
    public static function render()
    {
        return <<<HTML
            <div>This is a class component.</div>
        HTML;
    }
}
```

Passing props:
```php
namespace App\components;

class MyClassComponent {
    public static function render(string $prop1, string $prop2 = '')
    {
        return <<<HTML
            <div>This is a class component with props {$prop1} and {$prop2}.</div>
        HTML;
    }
}
```

You can call components inside components:
```php
namespace App\components;

class MyClassComponent {
    public static function render()
    {
        return <<<HTML
            <<div>This is a nested component: </div>
            <MyComponent />
        HTML;
    }
}
```
You can nest any type of component inside any type of component.

### Non-void components:

The parameter `$innerHtml` is used to pass content between opening and closing tags:
```php
namespace App\components;

class MyClassComponent {
    public static function render(string $innerHtml)
    {
        return <<<HTML
            <div>{$innerHtml}</div>
        HTML;
    }
}
```

## Limitations:

- No native way to enforce interfaces on functions.
- No PSR-4 autoloading for functions.
- IDEs can't provide type inference, auto-completion, or usage hints.
- Current implementation uses Regex. Should switch to a more robust and dedicated HTML parser, or write my own.

Switching to classes solves a set of problems, but static analysis will not be possible period, unless someone specifically writes a plugin/tool. Additionally, there is no clear use case where PHP components will be preferable over regular View files. Wrapping view files into classes for static analysis yields even more benefits. Still, an interesting experiment.

## Dependencies:

- Composer for class autoload.

## Deployment:

1. Clone the project. 
    ```
    git clone https://github.com/hhiruko/php-components.git`
    ```

2. Install composer. Alternatively, use your own autoload.
    ```
    composer install
    ```

3. Run a local server.
    ```
    php -S localhost:888
    ```
