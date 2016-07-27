<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModularServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $modules = config("module.modules");
        while (list(,$module) = each($modules)) {
            if(file_exists('../app/Modules/'.$module.'/routes.php')) {
                include '../app/Modules/'.$module.'/routes.php';
            }
            if(is_dir('../app/Modules/'.$module.'/Views')) {
                $this->loadViewsFrom('../app/Modules/'.$module.'/Views', $module);
            }
        }
    }
    public function register(){}
}