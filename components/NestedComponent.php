<?php

function NestedComponent() {
    return <<<HTML
        <div>This is a nested component: </div>
        <MyComponent name="Nested" origin="Nested" />
    HTML;
}