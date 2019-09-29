<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use DirectoryIterator;

class RouteServiceProvider extends ServiceProvider
{
    public const CONTAINERS_PATH = 'app'.DIRECTORY_SEPARATOR.'Containers';
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapContainerRoutes();
    }

    protected function mapContainerRoutes(){
        $containers = new DirectoryIterator(base_path(self::CONTAINERS_PATH));

        foreach ($containers as $key => $container) {
            if(!$container->isDot()){
                Route::group(
                    [
                        'middleware' => 'web',
                        'namespace' => 'App\Containers\\'.$container->getFileName().'\\Controllers'
                    ],
                    function($route) use ($container){
                        $this->loadContainerRoutes($container);
                    }
                );
            }
        }
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    protected function loadContainerRoutes($container){
        $fileStack = [$this->_getArrayFiles($container->getPathName().DIRECTORY_SEPARATOR.'routes')];
        $files = array_shift($fileStack);

        while($files!==null){
            foreach ($files as $key => $fileRoute) {
                if(!$fileRoute->isDot()){
                    if($fileRoute->isFile()){
                        $this->loadRoute($fileRoute->getPathName());
                    }else {
                        $fileStack[] = $this->_getArrayFiles($fileRoute->getPathName());
                    }
                }
            }
            $files = array_shift($fileStack);
        }
    }

    protected function loadRoute($route){
        require $route;
    }

    private function _getArrayFiles($path){
        return new DirectoryIterator($path);
    }
}
