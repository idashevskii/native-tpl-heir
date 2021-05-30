Tiny plain PHP native template inheritance library

[![Latest Stable Version](https://poser.pugx.org/edevelops/native-tpl-heir/v)](//packagist.org/packages/edevelops/native-tpl-heir) [![Total Downloads](https://poser.pugx.org/edevelops/native-tpl-heir/downloads)](//packagist.org/packages/edevelops/native-tpl-heir) [![Latest Unstable Version](https://poser.pugx.org/edevelops/native-tpl-heir/v/unstable)](//packagist.org/packages/edevelops/native-tpl-heir) [![License](https://poser.pugx.org/edevelops/native-tpl-heir/license)](//packagist.org/packages/edevelops/native-tpl-heir)

Inspired by [phpti](https://github.com/arshaw/phpti)

## Features

- About 35 lines of code at all
- No needs to know any template language other than PHP
- The entire API is just 3 global functions!
- Overridable blocks are not executed!
- No `ob_*` buffering used

## Usage

Without composer: just copy/include tiny [source](src/NativeTplHeir.php) directrly.

Using composer:

    $ composer require edevelops/native-tpl-heir

Then need to touch `NativeTplHeir` class to trigger auto-loading. For example

```php
new NativeTplHeir();
```

**API**

- `slot(string $name, Closure $render = null)` - the output point of the block in the template. `$name` - unique block name. `$render` - optional callback for rendering.
- `block(string $name, Closure $render)` - defining block to output in the `slot` of parent template. `$name` - unique block name. `$render` - callback for rendering.
- `super()` - calling the overridden parent's callback for rendering.

**Inheritance**

Just include parent template **at the end** of file.


## Example

**root.php:**

```php
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php slot('title')?></title>
  </head>
  <body>
    <div id="root">
      <?php slot('body', function () { ?>

        <p>'body' :: root.php</p>

      <?php }) ?>
    </div>
  </body>
</html>
```

**two-columns.php:**

```php

block('title', function () { ?>
  Title :: two-columns.php
<?php });

block('body', function () { ?>
  <div id="two-columnts">
    <div id="main">
      <?php slot('main', function () { ?>

        <p>'main' :: two-columns.php</p>

      <?php }) ?>
    </div>
    <div id="side">
      <?php slot('side', function () { ?>

        <p>'side' :: two-columns.php</p>

      <?php }) ?>
    </div>
  </div>
  <div id="footer">
    <?php slot('footer', function () { ?>

      <p>'footer' :: two-columns.php</p>

    <?php }) ?>
  </div>

<?php });

include __DIR__.'/root.php';
```

**index.php:**

```php
block('title', function () { ?> 'title' :: index.php <?php });

block('side', function () { ?>

  <p>'side' :: index.php</p>

<?php }); 

block('main', function () { ?>

 <div id="main-index-override">
    <?php super() ?>
  </div>

<?php });

block('main', function () { ?>

  <div id="main-index"> 
    <?php super() ?>
  </div>

<?php });

include __DIR__.'/two-columns.php';
```

**Rendered result** (formatted for better readability):

```html
<!DOCTYPE html>
<html>
  <head>
    <title> 'title' :: index.php </title>
  </head>
  <body>
    <div id="root">
      <div id="two-columnts">
        <div id="main">

          <div id="main-index-override">

            <div id="main-index"> 

              <p>'main' :: two-columns.php</p>

            </div>

          </div>

        </div>
        <div id="side">

          <p>'side' :: index.php</p>

        </div>
      </div>
      <div id="footer">

        <p>'footer' :: two-columns.php</p>

      </div>

    </div>
  </body>
</html>
```
