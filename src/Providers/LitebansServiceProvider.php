<?php

namespace Azuriom\Plugin\Litebans\Providers;

use Azuriom\Models\Permission;
use Illuminate\Pagination\Paginator;
use Azuriom\Extensions\Plugin\BasePluginServiceProvider;

class LitebansServiceProvider extends BasePluginServiceProvider
{

    /**
     * Register any plugin services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMiddlewares();

        //
    }

    /**
     * Bootstrap any plugin services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPolicies();

        $this->loadViews();

        $this->loadTranslations();

        $this->loadMigrations();

        $this->registerRouteDescriptions();

        $this->registerAdminNavigation();

        $this->registerUserNavigation();

        Paginator::useBootstrap();

        Permission::registerPermissions([
            'litebans.admin' => 'litebans::admin.permission',
        ]);
    }

    /**
     * Returns the routes that should be able to be added to the navbar.
     *
     * @return array
     */
    protected function routeDescriptions()
    {
        return [
            'litebans.index' => 'litebans::messages.plugin_name',
        ];
    }

    /**
     * Return the admin navigations routes to register in the dashboard.
     *
     * @return array
     */
    protected function adminNavigation()
    {
        return [
            'litebans' => [
                'name' => trans('litebans::admin.nav.title'),
                'icon' => 'bi bi-slash-circle',
                'route' => 'litebans.admin.settings',
                'permission' => 'litebans.admin'
            ],
        ];
    }

    /**
     * Return the user navigations routes to register in the user menu.
     *
     * @return array
     */
    protected function userNavigation()
    {

    }
}
