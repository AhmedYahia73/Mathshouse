<?php

namespace App\Providers;

 use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
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

        Gate::define('isMarketing', function (User $user) {
            if ( $user->position == 'admin' ) {
                return true;
            }
            elseif ( $user->position == 'user_admin' ) {
                $arr = $user->user_admin->user_role;
                foreach ($arr as $item) {
                    if ( $item->admin_role == 'Marketing' ) {
                        return true;
                    }
                }
            }
        });

        Gate::define('Admin', function (User $user) {
            if ( $user->position == 'admin' ) {
                return true;
            }
            elseif ( $user->position == 'user_admin' ) {
                $arr = $user->user_admin->user_role;
                foreach ($arr as $item) {
                    if ( $item->admin_role == 'Admin' ) {
                        return true;
                    }
                }
            }
        });

        Gate::define('Users', function (User $user) {
            if ( $user->position == 'admin' ) {
                return true;
            }
            elseif ( $user->position == 'user_admin' ) {
                $arr = $user->user_admin->user_role;
                foreach ($arr as $item) {
                    if ( $item->admin_role == 'Users' ) {
                        return true;
                    }
                }
            }
        });

        Gate::define('Courses', function (User $user) {
            if ( $user->position == 'admin' ) {
                return true;
            }
            elseif ( $user->position == 'user_admin' ) {
                $arr = $user->user_admin->user_role;
                foreach ($arr as $item) {
                    if ( $item->admin_role == 'Courses' ) {
                        return true;
                    }
                }
            }
        });

        Gate::define('Wallet', function (User $user) {
            if ( $user->position == 'admin' ) {
                return true;
            }
            elseif ( $user->position == 'user_admin' ) {
                $arr = $user->user_admin->user_role;
                foreach ($arr as $item) {
                    if ( $item->admin_role == 'User Wallet' ) {
                        return true;
                    }
                }
            }
        });

        Gate::define('Settings', function (User $user) {
            if ( $user->position == 'admin' ) {
                return true;
            }
            elseif ( $user->position == 'user_admin' ) {
                $arr = $user->user_admin->user_role;
                foreach ($arr as $item) {
                    if ( $item->admin_role == 'Settings' ) {
                        return true;
                    }
                }
            }
        });

        Gate::define('Reports', function (User $user) {
            if ( $user->position == 'admin' ) {
                return true;
            }
            elseif ( $user->position == 'user_admin' ) {
                $arr = $user->user_admin->user_role;
                foreach ($arr as $item) {
                    if ( $item->admin_role == 'Reports' ) {
                        return true;
                    }
                }
            }
        });

        Gate::define('Live', function (User $user) {
            if ( $user->position == 'admin' ) {
                return true;
            }
            elseif ( $user->position == 'user_admin' ) {
                $arr = $user->user_admin->user_role;
                foreach ($arr as $item) {
                    if ( $item->admin_role == 'Live' ) {
                        return true;
                    }
                }
            }
        });

        Gate::define('Packages', function (User $user) {
            if ( $user->position == 'admin' ) {
                return true;
            }
            elseif ( $user->position == 'user_admin' ) {
                $arr = $user->user_admin->user_role;
                foreach ($arr as $item) {
                    if ( $item->admin_role == 'Packages' ) {
                        return true;
                    }
                }
            }
        });

        Gate::define('ReportIssues', function (User $user) {
            if ( $user->position == 'admin' ) {
                return true;
            }
            elseif ( $user->position == 'user_admin' ) {
                $arr = $user->user_admin->user_role;
                foreach ($arr as $item) {
                    if ( $item->admin_role == 'ReportIssues' ) {
                        return true;
                    }
                }
            }
        });

        Gate::define('Payment', function (User $user) {
            if ( $user->position == 'admin' ) {
                return true;
            }
            elseif ( $user->position == 'user_admin' ) {
                $arr = $user->user_admin->user_role;
                foreach ($arr as $item) {
                    if ( $item->admin_role == 'Payment' ) {
                        return true;
                    }
                }
            }
        });

        Gate::define('Slider', function (User $user) {
            if ( $user->position == 'admin' ) {
                return true;
            }
            elseif ( $user->position == 'user_admin' ) {
                $arr = $user->user_admin->user_role;
                foreach ($arr as $item) {
                    if ( $item->admin_role == 'Slider' ) {
                        return true;
                    }
                }
            }
        });

        Gate::define('Affilate', function (User $user) {
            if ( $user->position == 'admin' ) {
                return true;
            }
            elseif ( $user->position == 'user_admin' ) {
                $arr = $user->user_admin->user_role;
                foreach ($arr as $item) {
                    if ( $item->admin_role == 'Affilate' ) {
                        return true;
                    }
                }
            }
        });
    }
}
