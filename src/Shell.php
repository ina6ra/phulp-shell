<?php

namespace Phulp\Plugin;

use Phulp\Phulp;

class Shell
{
    private $phulp = null;

    public $config = [];
    public $env = [];
    public $argv = [];

    public function __construct(Phulp $phulp = null)
    {
        $config = getcwd() . '/composer.json';
        if (file_exists($config)) {
            $json = file_get_contents($config);
            $json = json_decode($json, true);
            $config = isset($json['config']) ? $json['config'] : [];
            foreach ($config as $key => $value) {
                $value = exec('echo ' . $value);
                if (ctype_upper(str_replace('_', '', $key))) {
                    $this->env[$key] = $value;
                } else {
                    $this->config[$key] = $value;
                }
            }
        }
        $anyenv = exec('echo $HOME/.anyenv');
        if (! isset($this->env['ANYENV_ROOT']) && file_exists($anyenv)) {
            $this->env['ANYENV_ROOT'] = $anyenv;
        }
        $this->argv = $_SERVER['argv'];
        $this->phulp = $phulp ?: new Phulp();
    }

    public function exec(array $command, $async = false, callable $callback = null)
    {
        $command = $this->createCommand($command);
        $dryrun = isset($this->config['phulp_dry_run']) ? $this->config['phulp_dry_run'] : false;
        if ($dryrun) {
            var_dump($command);
        } else {
            $this->phulp->exec($command, $async, $callback);
        }
    }

    public function createCommand(array $command)
    {
        if (! isset($command['env'])) {
            $command['env'] = $this->env;
        }
        if (! isset($command['env']['PATH'])) {
            $command['env']['PATH'] = getenv('PATH');
        }
        if (isset($command['env']['BASHRC_PATH'])) {
            $command['command'] =
                "shopt -s expand_aliases;source {$command['env']['BASHRC_PATH']};"
                ."\n{$command['command']}";
        }
        if (! isset($command['cwd'])) {
            $command['cwd'] = '$PWD';
        }
        $command['cwd'] = exec('echo ' . $command['cwd']);
        return $command;
    }
}
