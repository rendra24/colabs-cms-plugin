<?php

namespace Colabs\Cms\Commands;

use Config\Autoload;
use CodeIgniter\CLI\CLI;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\Publisher\Publisher;
use Throwable;

class Publish extends BaseCommand
{
    protected $group       = 'CMS Builder';
    protected $name        = 'cms:publish';
    protected $description = 'Publish Javascript for Colabs CMS Plugin.';
    protected $namespace   = null;

    public function run(array $params)
    {
        $this->determineSourcePath();
        CLI::write($this->sourcePath);

        
        $this->publishJS();
    }

    protected function publishJS()
    {
        $path = "$this->sourcePath/Views/js/cms.js";

        $content = file_get_contents($path);

        $this->writeFile("js/cms.js", $content, true);
    }

    /**
     * Determines the current source path from which all other files are located.
     */
    protected function determineSourcePath()
    {
        $this->sourcePath = realpath(__DIR__ . '/../');

        if ($this->sourcePath == '/' || empty($this->sourcePath)) {
            CLI::error('Unable to determine the correct source directory. Bailing.');
            exit();
        }
    }

    /**
     * Write a file, catching any exceptions and showing a
     * nicely formatted error.
     *
     * @param string $path
     * @param string $content
     */
    protected function writeFile(string $path, string $content, bool $public = false)
    {
        $config = new Autoload();

        if ($public) {
            $publicPath = FCPATH;
            $filename = $publicPath . $path;
            $directory = dirname($filename);
        } else {
            $appPath = $config->psr4[APP_NAMESPACE];
            $filename = $appPath . $path;
            $directory = dirname($filename);
        }

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        if (file_exists($filename)) {
            $overwrite = (bool) CLI::getOption('f');

            if (!$overwrite && CLI::prompt("  File '{$path}' already exists in destination. Overwrite?", ['n', 'y']) === 'n') {
                CLI::error("  Skipped {$path}. If you wish to overwrite, please use the '-f' option or reply 'y' to the prompt.");
                return;
            }
        }

        if (write_file($filename, $content)) {
            CLI::write(CLI::color('  Created: ', 'green') . $path);
            if ($public) {
                CLI::write(CLI::color('  load this path to html page: ', 'blue') . $path);
            }
        } else {
            CLI::error("  Error creating {$path}.");
        }
    }
}