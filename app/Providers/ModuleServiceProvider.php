<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    private $modules = ['User'];
    private $deferModules = ['User'];

    private $excludeRepository = [];

    /**
     * Register the application services.
     *
     * @return void
     */

    public function register()
    {
        $this->bindModules($this->modules);
    }


    /**
     * Binds module service and repository
     * @param $modules List of modules you want to bind.
     */
    private function bindModules($modules)
    {
        foreach ($modules as $module) {
            $this->bindService($module);

            if (!in_array($module, $this->excludeRepository))
                $this->bindRepository($module);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        $providers = [];
        foreach ($this->deferModules as $module) {
            array_push($providers, "App\\Modules\\{$module}\\Service\\Contract\\{$module}ServiceInterface");
            array_push($providers, "App\\Modules\\{$module}\\Repository\\Contract\\{$module}RepositoryInterface");
        }

        return $providers;
    }

    /**
     * Bind service.
     * @param $module
     */
    private function bindService($module)
    {
        $serviceContractPath = "App\\Modules\\{$module}\\Service\\Contract\\{$module}ServiceInterface";
        $servicePath = "App\\Modules\\{$module}\\Service\\{$module}Service";
        $this->app->singleton($serviceContractPath, $servicePath);
    }

    /**
     * Bind repository.
     * @param $module
     */
    private function bindRepository($module)
    {
        $repoContractPath = "App\\Modules\\{$module}\\Repository\\Contract\\{$module}RepositoryInterface";
        $repoPath = "App\\Modules\\{$module}\\Repository\\{$module}Repository";
        $this->app->singleton($repoContractPath, $repoPath);
    }

}
