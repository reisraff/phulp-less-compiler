# phulp-less-compiler

The less-compiler addon for [PHULP](https://github.com/reisraff/phulp). It's a wrapper for [less.php](https://github.com/oyejorge/less.php).

## Install

```bash
$ composer require reisraff/phulp-less-compiler
```

## Usage

```php
<?php

use Phulp\LessCompiler\LessCompiler;

$phulp->task('less', function ($phulp) {
    $phulp->src(['src/'], '/css$/')
        // compile
        ->pipe(new LessCompiler)
        // write your compiled files
        ->pipe($phulp->dest('dist/'));
});

```

### Options

***URI*** : The uri root to prepend to any relative image or @import urls in the .less file.

```php
<?php

use Phulp\LessCompiler\LessCompiler;

$compiler = new LessCompiler([
    // default: null
    'uri' => '../../'
]);

```
