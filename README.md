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
    "BASHRC_PATH": "$HOME/.bashrc"
  }
}
```

```
<?php

// phulpfile.php

$phulp->task('taskname', function($phulp) {
  $shell = new \Phulp\Plugin\Shell($phulp);
  $shell->exec([
    'command' => 'alias command'
  ]);
});
```

### Run

```
$ phulpsh taskname
```

### Caution:

``BASHRC_PATH`` is Absolute path
