<?php

function MyComponent(string $name, string $origin) {
    $var = 'Hello world!';
    return <<<HTML
        <div>{$name} from {$origin} says: </div>
        <div style="color: blue;">{$var}</div>
    HTML;
}