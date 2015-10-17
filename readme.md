## Ninjecture
A simple module based architecture for your Laravel projects. Ninjecture, uses two common design patterns within the module logic. 
The repository pattern, as the data mapping layer. And the service pattern for any kind of business logic.

## Installation
Before you can install all necessary dependencies, you have first to comment out the following service provider `Kreshnik\Dbtruncate\DbtruncateServiceProvider::class` found in [config/app.php](https://github.com/Kreshnik/ninjecture/blob/master/config/app.php). 
Once you have installed all project dependencies, using composer. You can uncomment the line again.

## Folder Structure
### Generics
[app/Generics](https://github.com/Kreshnik/ninjecture/tree/master/app/Generics)
Here we do have all our generic classes, at th moment we do have two `GenericRepository` and `GenericService`. These generic classes, include some predefined methods to help you out. These are already inherited within every generated service, repository file. 

### Models
[app/Models](https://github.com/Kreshnik/ninjecture/tree/master/app/Models)
Here you have your standard eloquent models. If you use the module generate console command, the model will be generated automatically. 

### Modules
[app/Models](https://github.com/Kreshnik/ninjecture/tree/master/app/Modules)
Here is the location of your modules, an module if made of two parts, Repositories and Services.

#### Module usage
Once a module has been generated, using the module generator console command. You have to add the module name to the module service provider, found in the [app/Providers](https://github.com/Kreshnik/ninjecture/blob/master/app/Providers/ModuleServiceProvider.php) directory. Please have a look at Laravel's [Service Container](http://laravel.com/docs/5.1/container) to further understand what is happening.
A sample module is already provided called `User`, and registered with the module service provider. Once you have done this part, you will be able to inject the module service into your controller. You can find a sample controller called [`UserController`](https://github.com/Kreshnik/ninjecture/blob/master/app/Http/Controllers/UserController.php), which uses the `User` module service.
As you may see, I inject always the `ServiceInterface` of the module, into the controller method. Which means all method signatures need to be declared first into their representing interfaces. This makes it easier to test code later on, as we use Laravel's dependency injector.
 
### Traits
[app/Traits](https://github.com/Kreshnik/ninjecture/tree/master/app/Traits)
Here is the location of application traits. Currently there is just one called ResponseTypes. This trait helps you handle json responses, it is used within the UserController as demonstration.

## Commands
A few helper console commands are include within the project;
1. `php artisan make:exception` - Helps generate custom exceptions.
2. `php artisan make:module` - Generates all necessary files for a module.
3. `php artisan db:truncate` - Truncates db tables, please see the following link [dbtruncate](https://github.com/Kreshnik/dbtruncate).


