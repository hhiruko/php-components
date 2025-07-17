<?php

function NonVoidComponent(string $innerHtml) {
    return <<<HTML
        <div>This is a non-void component:</div>
        <div><b>{$innerHtml}</b></div>
    HTML;
}