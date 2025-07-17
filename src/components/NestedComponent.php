<?php

function NestedComponent() {
    return <<<HTML
        <div>This is a nested component: </div>
        <MyComponent name="MyComponent" origin="NestedComponent" />
    HTML;
}