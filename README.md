# phulp-less-compiler

The less-compiler addon for [PHULP](https://github.com/reisraff/phulp)

## Install

```bash
$ composer require reisraff/phulp-less-compiler:dev-master
```

## Usage

```php
<?php

use Phulp\Phulp;
use LessCompiler\LessCompiler;

class PhulpFile extends Phulp
{
    public function define()
    {
        Phulp::task('less', function () {
            Phulp::src(['src/'], '/css$/')
                ->pipe(new LessCompiler)
                ->pipe(Phulp::dest('dist'));
        });
    }
}

```

### Options

***URI*** : The uri root to prepend to any relative image or @import urls in the .less file.

```php
<?php

use LessCompiler\LessCompiler;

$compiler = new LessCompiler('../../');

```
