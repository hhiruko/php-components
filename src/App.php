<?php

namespace App;

use App\core\View;

class App {
    public static function view() {
        return View::render('my-view', ['name' => 'MyComponent']);
    }
}