<?php

namespace Phulp\Shell;

use Phulp\Phulp;
use Symfony\Component\Dotenv\Dotenv;

class Shell {

  private $phulp = null;

  public function __construct(Phulp $phulp = null) {
    $path = getcwd().'/.phulp';
    if (file_exists($path)) {
        $dotenv = new Dotenv();
        $dotenv->load($path);
    }
    $this->phulp = $phulp ?: new Phulp();
  }

  public function exec(array $command, $async = false, callable $callback = null) {
    if ( ! isset($command['env']['PATH']) ) $command['env']['PATH'] = getenv('PATH');
    if ( isset($command['env']['BASHRC_PATH']) ) {
      $command['command'] = 'shopt -s expand_aliases;source $BASHRC_PATH;'."\n{$command['command']}";
    }
    $this->phulp->exec($command, $async, $callback);
  }
}
