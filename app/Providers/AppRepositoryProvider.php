<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class AppRepositoryProvider extends ServiceProvider  {

    /**
     * Register all repositories.
     *
     * @author	Andrea Marco Sartori
     * @return	void
     */
    public function register()
    {
        $this->registerPostRepository();
    }


    public function registerPostRepository()
    {
        $repository = 'App\Awesome\Modules\ModuleRepository';
        $this->app->bind('App\Awesome\Modules\ModuleInterface', $repository);

        $repository = 'App\Awesome\Slots\SlotRepository';
        $this->app->bind('App\Awesome\Slots\SlotInterface', $repository);

        $repository = 'App\Awesome\Pages\PageRepository';
        $this->app->bind('App\Awesome\Pages\PageInterface', $repository);

        $repository = 'App\Awesome\Templates\TemplateRepository';
        $this->app->bind('App\Awesome\Templates\TemplateInterface', $repository);

    }
} 