<?php

namespace App\components;

class MyClassComponent {
    public static function render()
    {
        return <<<HTML
            <div>This is a Class component.</div>
            <MyComponent name="MyComponent" origin="MyClassComponent" />
        HTML;
    }
}