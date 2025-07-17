<?php

namespace App\components;

use App\components\MyClassComponent;

class NestedClassComponent {
    public static function render()
    {
        return <<<HTML
            <div>This is a nested class component.</div>
            <MyClassComponent />
        HTML;
    }
}