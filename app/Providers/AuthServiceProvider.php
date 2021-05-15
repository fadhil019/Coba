<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('admin_sistem', function($user){
            return $user->bagian == 'Admin sistem';
        });
        Gate::define('admin_remu', function($user){
            return $user->bagian == 'Admin remunerasi';
        });
        Gate::define('admin_ruangan', function($user){
            return $user->bagian == 'Admin ruangan';
        });
        Gate::define('kolektif_data', function($user){
            return $user->bagian == 'Kolektif data';
        });
        Gate::define('manajemen_remu', function($user){
            return $user->bagian == 'Manajemen remunerasi';
        });
        Gate::define('penunjang', function($user){
            return $user->bagian == 'Penunjang remunerasi';
        });
        Gate::define('perawat', function($user){
            return $user->bagian == 'Perawat remunerasi';
        });
        //
    }
}
