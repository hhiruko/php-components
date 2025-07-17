<?php

namespace App\components;

class NonVoidClassComponent {
    public static function render(string $innerHtml)
    {
        return <<<HTML
            <div>This is a non-void class component.</div>
            <div><b>{$innerHtml}</b></div>
        HTML;
    }
}