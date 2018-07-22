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
    "phulp_multi_task": false
  }
}
```

|name|default|require|detail|
|:---|:---|:---|:---|
|BASHRC_PATH|-|true|bashrc path|
|vendor-dir|-|-|custom vendor dir|
|phulp_multi_task|false|-|disable multi task|

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

``phulp_multi_task: false``

```
$ phulpsh taskname argv1 argv2
```

``phulp_multi_task: true``

```
$ phulpsh taskname taskname2 taskname3
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
