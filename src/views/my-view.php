<?php 

use App\components\MyClassComponent;
use App\components\NestedClassComponent;
use App\components\NonVoidClassComponent;

?>

<div>
    <MyComponent name="<?= $name ?>" origin="my-view" />
    <br/>
    <NestedComponent />
    <br/>
    <NonVoidComponent>Text between opening and closing tags.</NonVoidComponent>
    <br/>
    <MyClassComponent />
    <br/>
    <NestedClassComponent />
    <br/>
    <NonVoidClassComponent>Text between opening and closing tags.</NonVoidClassComponent>
</div>