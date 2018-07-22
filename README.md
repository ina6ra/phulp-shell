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
    "BASHRC_PATH": "$HOME/.bashrc",
    "vendor-dir": "$HOME/vendor",
    "phulp_multi_task": false,
    "phulp_dry_run": false
  }
}
```

|name|default|require|detail|
|:---|:---|:---|:---|
|BASHRC_PATH|-|true|bashrc path|
|vendor-dir|-|-|custom vendor dir|
|phulp_multi_task|false|-|disable multi task|
|phulp_dry_run|false|-|dry run for phulpsh|

```
<?php

// phulpfile.php

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

``BASHRC_PATH`` is Absolute path

## Test

```
$ git clone https://github.com/inaling/phulp-shell
$ cd phulp-shell
$ composer install
$ composer test
```
