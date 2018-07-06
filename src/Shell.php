<?php

namespace Phulp\Shell;
use Phulp\Phulp;

class Shell {

  private $phulp = null;

  public $config = [];
  public $env = [];
  public $argv = [];

  public function __construct(Phulp $phulp = null) {
    $config = getcwd() . '/composer.json';
    if ( file_exists($config) ) {
        $json = file_get_contents($config);
        $json = json_decode($json, true);
        foreach($json['config'] as $key => $value) {
            $value = exec('echo ' . $value);
            if( ctype_upper(str_replace('_', '', $key)) ) $this->env[$key] = $value;
            else $this->config[$key] = $value;
        }
    }
    $this->argv = $_SERVER['argv'];
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
