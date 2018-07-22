# Phulp Shell

It's a third-party project that's wrapper for "phulp exec function"

## Usage

### Install:

```
# composer.json
{
  "repositories": [{
    "type": "vcs",
    "url": "https://github.com/inaling/phulp-shell"
  }],
  "require": {
    "inaling/phulp-shell": "dev-master"
  }
}
```

```
$ composer install
```

### Using:

```
# composer.json
{
  "config": {
    "vendor-dir": "$HOME/vendor",
    "phulp_bashrc_path": "$HOME/.bashrc",
    "phulp_multi_task": false
  }
}
```

|name|default|require|detail|
|:---|:---|:---|:---|
|phulp_bashrc_path|-|true|absolute bashrc path|
|phulp_multi_task|false|-|disable multi task|

```
<?php

// PhulpFile.php

$phulp->task('taskname', function ($phulp) {
    $shell = new \Phulp\Plugin\Shell($phulp);
    $shell->exec([
        'command' => 'alias command'
    ]);
});
```

### Run:

```
$ phulpsh taskname
```

## Caution

``phulp_bashrc_path`` is Absolute path

## Test

```
$ git clone https://github.com/inaling/phulp-shell
$ cd phulp-shell
$ composer install
$ composer test
```
