<?php

function NonVoidComponent(string $innerHtml) {
    return <<<HTML
        <div>This is a non-void component:</div>
        <b>{$innerHtml}</b>
    HTML;
}