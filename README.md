# PHP Functional Components

A proof-of-concept implementation of functional components for template rendering in PHP, inspired by JSX.

### Defining components:

You can use components in your view files:
```html
<div>
    <MyComponent />
</div>
```

Define a component first:
```php
function MyComponent() {
    return <<<HTML
        <div>This is a component.</div>
    HTML;
}
```

### Passing props:

You can pass props:
```html
<div>
    <MyComponent prop1="prop1" prop2="prop2" />
</div>
```

```php
function MyComponent(string $prop1, string $prop2 = '') {
    return <<<HTML
        <div>This is a component with props {$prop1} and {$prop2}.</div>
    HTML;
}
```

### Nesting components:

You can call components inside components:
```php
function NestedComponent() {
    return <<<HTML
        <div>This is a nested component: </div>
        <MyComponent />
    HTML;
}
```

### Non-void components:

```php
<div>
    <MyComponent>This is a component with a closing tag.</MyComponent>
</div>
```

The parameter `$innerHtml` is used to pass content between opening and closing tags:
```php
function MyComponent(string $innerHtml) {
    return <<<HTML
        <div>{$innerHtml}</div>
    HTML;
}
```