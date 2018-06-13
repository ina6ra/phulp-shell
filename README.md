# Phulp Shell

It's a third-party project that's wrapper for "phulp exec function"

## Usage

### Install:

```
{
  "repositories": [{
    "type": "vcs",
    "url": "https://github.com/17ringe/phulp-shell"
  }],
  "require": {
    "17ringe/phulp-shell": "dev-master"
  }
}
```

```
$ composer install
```

### Using:

```
# .phulp
PATH=$PATH
BASHRC_PATH=$HOME/.bashrc
```

```
<?php

// phulpfile.php

$phulp->task('default', function($phulp) {
  $shell = new \Phulp\Shell\Shell($phulp);
  $shell->exec([
    'command' => 'alias command',
    'env' => $_ENV
  ]);
});
```

### Caution:

``BASHRC_PATH`` is Absolute path
