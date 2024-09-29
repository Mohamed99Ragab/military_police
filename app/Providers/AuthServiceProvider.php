<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Enums\RoleEnum;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function($user){
            if($user->role == RoleEnum::Admin){
                return true;
            }
    });



        Gate::define('manage-users',function($user){
                return $user->role == RoleEnum::Admin;
        });

        Gate::define('log-viewer',function($user){
            return $user->role == RoleEnum::Admin;
        });

        Gate::define('view-soliders',function($user){
            return ($user->role == RoleEnum::Solider)  ||  ($user->role == RoleEnum::OfficerClass);
        });

        Gate::define('create-solider',function($user){
            return ($user->role == RoleEnum::Solider)  ||  ($user->role == RoleEnum::OfficerClass);
        });

        Gate::define('edit-solider',function($user){
            return ($user->role == RoleEnum::Solider)  ||  ($user->role == RoleEnum::OfficerClass);
        });

        Gate::define('delete-solider',function($user){
            return ($user->role == RoleEnum::OfficerClass);
        });



        Gate::define('view-service-solider',function($user){
            return ($user->role == RoleEnum::Solider)  ||  ($user->role == RoleEnum::OfficerClass);
        });

        Gate::define('create-service-solider',function($user){
            return   ($user->role == RoleEnum::OfficerClass);
        });


        Gate::define('edit-service-solider',function($user){
            return   ($user->role == RoleEnum::OfficerClass);
        });

        Gate::define('delete-service-solider',function($user){
            return   ($user->role == RoleEnum::OfficerClass);
        });

        Gate::define('view-vacations',function($user){
            return ($user->role == RoleEnum::Solider)  ||  ($user->role == RoleEnum::OfficerClass);
        });

        Gate::define('create-vacation',function($user){
            return ($user->role == RoleEnum::Solider)  ||  ($user->role == RoleEnum::OfficerClass);
        });

        Gate::define('delete-vacation',function($user){
            return  ($user->role == RoleEnum::OfficerClass);
        });


        Gate::define('view-solider-report',function($user){
            return ($user->role == RoleEnum::Solider)  ||  ($user->role == RoleEnum::OfficerClass);
        });

        Gate::define('view-vacation-report',function($user){
            return ($user->role == RoleEnum::Solider)  ||  ($user->role == RoleEnum::OfficerClass);
        });


        Gate::define('view-services',function($user){
            return ($user->role == RoleEnum::Solider)  ||  ($user->role == RoleEnum::OfficerClass);
        });

        Gate::define('create-service',function($user){
            return ($user->role == RoleEnum::Solider)  ||  ($user->role == RoleEnum::OfficerClass);
        });

        Gate::define('edit-service',function($user){
              ($user->role == RoleEnum::OfficerClass);
        });

        Gate::define('delete-service',function($user){
              ($user->role == RoleEnum::OfficerClass);
        });


        Gate::define('view-service-places',function($user){
            return ($user->role == RoleEnum::Solider)  ||  ($user->role == RoleEnum::OfficerClass);
        });

        Gate::define('create-service-place',function($user){
            return ($user->role == RoleEnum::Solider)  ||  ($user->role == RoleEnum::OfficerClass);
        });

        Gate::define('edit-service-place',function($user){
              ($user->role == RoleEnum::OfficerClass);
        });

        Gate::define('delete-service-place',function($user){
              ($user->role == RoleEnum::OfficerClass);
        });



        Gate::define('view-degrees',function($user){
            return ($user->role == RoleEnum::Solider)  ||  ($user->role == RoleEnum::OfficerClass);
        });

        Gate::define('create-degree',function($user){
            return ($user->role == RoleEnum::Solider)  ||  ($user->role == RoleEnum::OfficerClass);
        });

        Gate::define('edit-degree',function($user){
              ($user->role == RoleEnum::OfficerClass);
        });

        Gate::define('delete-degree',function($user){
              ($user->role == RoleEnum::OfficerClass);
        });


        Gate::define('view-shifts',function($user){
            return ($user->role == RoleEnum::Solider)  ||  ($user->role == RoleEnum::OfficerClass);
        });

        Gate::define('create-shift',function($user){
            return ($user->role == RoleEnum::Solider)  ||  ($user->role == RoleEnum::OfficerClass);
        });

        Gate::define('edit-shift',function($user){
              ($user->role == RoleEnum::OfficerClass);
        });

        Gate::define('delete-shift',function($user){
              ($user->role == RoleEnum::OfficerClass);
        });








    }
}
