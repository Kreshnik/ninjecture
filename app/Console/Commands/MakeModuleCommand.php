<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModuleCommand extends Command
{

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:module';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Creates a new module';
	private $lowerCaseName;
	private $properCaseName;
	private $templateFolder = '/domain_templates/Module/';
	private $vendor = 'App';
	private $vendorPath = '/app/Modules/';
	private $moduleFiles = [

		'Model'      => [
			[
				'templateFolder' => '/domain_templates/',
				'vendorPath'     => '/app/Models/',
				'folder'         => 'Model',
				'file'           => 'Model.txt'
			]
		],

		'Repository' => [
			[
				'folder' => 'Repository',
				'file'   => 'ModuleRepository.txt'
			],
			[
				'folder' => 'Repository/Contract',
				'file'   => 'ModuleRepositoryInterface.txt'
			]
		],

		'Service'    => [
			[
				'folder' => 'Service',
				'file'   => 'ModuleService.txt'
			],
			[
				'folder' => 'Service/Contract',
				'file'   => 'ModuleServiceInterface.txt'
			]
		],

	];
	private $includeModel = false;
	private $includeRepository = false;
	private $includeService = false;

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
		$this->askForModuleName();
		//$this->confirmTemplates();

		$this->loadTemplates();
		$this->buildModule();

	}

	private function loadTemplates()
	{
		foreach ( $this->moduleFiles as $templateName => $template )
		{
			foreach ( $template as $key => $templateFile )
			{
				$templateFolder = (isset($templateFile['templateFolder'])) ? $templateFile['templateFolder'] : $this->templateFolder;
				$fileContent = File::get(__DIR__ . $templateFolder . $templateFile['folder'] . '/' . $templateFile['file']);
				$fileContent = str_replace('$NAME$', $this->properCaseName, $fileContent);
				$fileContent = str_replace('$VENDOR$', $this->vendor, $fileContent);
				$fileContent = str_replace('$MODULE$', $this->properCaseName, $fileContent);
				$fileContent = str_replace('$LNAME$', $this->lowerCaseName, $fileContent);
				$this->moduleFiles[$templateName][$key]['content'] = $fileContent;
			}
		}
		$this->info('Templates loaded!');
	}

	private function buildModule()
	{
		foreach ( $this->moduleFiles as $template )
		{
			foreach ( $template as $key => $templateFile )
			{
				$folder = base_path() . $this->vendorPath . $this->properCaseName . '/' . $templateFile['folder'];

				if ( (isset($templateFile['vendorPath'])) )
					$folder = base_path() . $templateFile['vendorPath'];

				if ( !File::exists($folder) ) {
					File::makeDirectory($folder, 0775, true);
				}

				if ( File::exists($folder) ) {
					$fileName = str_replace('Model', $this->properCaseName, $templateFile['file']);
					$fileName = str_replace('Module', $this->properCaseName, $fileName);
					$fileName = str_replace('.txt', '.php', $fileName);
					File::put($folder . '/' . $fileName, $templateFile['content']);
				}
			}
		}
		$this->info('Files created!');
	}

	private function confirmTemplates()
	{
		$this->includeService = $this->confirm('Do you want to generate service files? [yes|no]');
		$this->includeRepository = $this->confirm('Do you want to generate repository files? [yes|no]');
		$this->includeModel = $this->confirm('Do you want to generate a model? [yes|no]');
	}

	private function askForModuleName()
	{
		$name = $this->ask('Module name:');
		$this->lowerCaseName = strtolower($name);
		$this->properCaseName = ucfirst($name);
	}

}