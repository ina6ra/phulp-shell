<?php

namespace Phulp\Shell;
use Phulp\Phulp;

class Shell {

  private $phulp = null;
  private $env = [];

  public function __construct(Phulp $phulp = null) {
    $config = getcwd() . '/phulp.json';
    if ( file_exists($config) ) {
        $json = file_get_contents($config);
        $json = json_decode($json, true);
        foreach($json as $key => $value) {
            $value = exec("echo " . $value);
            if( $value ) $this->env[$key] = $value;
        }
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

  public function getConfig($name = null) {
    if ( $name ) {
      return $this->env[$name];
    } else {
      return $this->env;
    }
  }
}
