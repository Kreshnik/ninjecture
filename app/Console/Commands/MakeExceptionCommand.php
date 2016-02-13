<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeExceptionCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:exception';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new exception';

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->ask('Exception name:');
        $this->lowerCaseName = strtolower($name);
        $this->properCaseName = ucfirst($name);
        $this->loadTemplates();
        $this->createModule();
    }

    private $lowerCaseName;
    private $properCaseName;
    private $templateFolder = '/domain_templates/';
    private $vendor = 'App';
    private $vendorPath = '/app/';

    private $moduleFiles = [
        ['folder' => 'Exceptions', 'file' => 'NameException.txt'],
    ];

    private function loadTemplates()
    {
        foreach ($this->moduleFiles as $key => $module) {
            $fileContent = File::get(__DIR__.$this->templateFolder.$module['folder'].'/'.$module['file']);
            $fileContent = str_replace('$NAME$', $this->properCaseName, $fileContent);
            $fileContent = str_replace('$VENDOR$', $this->vendor, $fileContent);
            $fileContent = str_replace('$MODULE$', $this->properCaseName, $fileContent);
            $fileContent = str_replace('$LNAME$', $this->lowerCaseName, $fileContent);
            $this->moduleFiles[$key]['content'] = $fileContent;
        }
        $this->info('Templates loaded!');
    }

    private function createModule()
    {
        foreach ($this->moduleFiles as $module) {
            $folder = base_path().$this->vendorPath.$module['folder'];

            if (!File::exists($folder)) {
                File::makeDirectory($folder, 0775, true);
            }
            if (File::exists($folder)) {
                $fileName = str_replace('Name', $this->properCaseName, $module['file']);
                $fileName = str_replace('.txt', '.php', $fileName);
                File::put($folder.'/'.$fileName, $module['content']);
            }
        }
        $this->info('Files created!');
    }
}
