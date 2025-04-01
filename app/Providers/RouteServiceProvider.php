<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use ReflectionClass;
use ReflectionMethod;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
        $this->mapAutoRoutes();
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }


    protected function mapAutoRoutes()
    {
        $namespace = 'App\Http\Controllers';
        $controllers = $this->getAllControllers();
        // dd($controllers);
        foreach ($controllers as $controller) {
            $controllerClass = "$namespace\\$controller";
            $reflection = new ReflectionClass($controllerClass);
            $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
            // echo($controller);
            foreach ($methods as $method) {
                if ($method->class === $controllerClass && $method->name !== '__construct') {
                    $routePath = str_replace("\\",'/',str_replace('controller','',strtolower($controller))) . '/' . strtolower($method->name=='index'?'/':$method->name);
                    // Route::any($routePath, [$controllerClass, $method->name]);
                    // Analyze method parameters
                    $parameters = $method->getParameters();
                    $parameterPaths = [];
                    foreach ($parameters as $parameter) {
                        // echo '<pre>';
                        // // echo($controller);
                        // echo '<br/>';
                        // var_dump($parameter);
                        // echo '<br/>';
                        // var_dump($parameter->getType());
                        // echo '</pre>';

                        // if($controller=="client\ShopController"){
                        //     dd($parameter->getType());
                        // }else{
                        //     // dd($parameter->getType());
                        // }
                        if ($parameter->getType()!=null) {
                            continue;
                        }
                        $parameterPaths[] = '{' . $parameter->getName() . '}';
                    }

                    // Append parameter placeholders to the route
                    if (!empty($parameterPaths)) {
                        $routePath .= '/' . implode('/', $parameterPaths);
                    }

                    // Define the route
                    // Route::any($routePath, [$controllerClass, $method->name]);
                    // ✅ Apply web middleware globally
                    // Route::any($routePath, [$controllerClass, $method->name])->middleware('web');
                    if ($routePath !== 'login') {
                        Route::any($routePath, [$controllerClass, $method->name])->middleware(['web', 'auth']);
                    } else {
                        Route::any($routePath, [$controllerClass, $method->name])->middleware('web');
                    }
                }
            }
        }
        // dd('dklsf');

    }

    protected function getAllControllers()
    {
        $path=app_path('Http/Controllers');
        $controllers = [];
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $relativePath = str_replace($path . DIRECTORY_SEPARATOR, '', $file->getPathname());
                $class =  str_replace(['/', '\\'], '\\', rtrim($relativePath, '.php'));
                $controllers[] = $class;
            }
        }

        return $controllers;
    }
}
