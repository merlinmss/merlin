<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\PastorRepositoryInterface;
use App\Repositories\Contracts\CarecellLeaderRepositoryInterface;
use App\Repositories\Contracts\CarecellAreaRepositoryInterface;
use App\Repositories\Contracts\CarecellMeetingRepositoryInterface;

use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\PastorRepository;
use App\Repositories\Eloquent\CarecellLeaderRepository;
use App\Repositories\Eloquent\CarecellAreaRepository;
use App\Repositories\Eloquent\CarecellMeetingRepository;

use Illuminate\Support\Facades\Gate;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PastorRepositoryInterface::class, PastorRepository::class);
        $this->app->bind(CarecellLeaderRepositoryInterface::class, CarecellLeaderRepository::class);
        $this->app->bind(CarecellAreaRepositoryInterface::class, CarecellAreaRepository::class);
        $this->app->bind(CarecellMeetingRepositoryInterface::class, CarecellMeetingRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('super-admin', function ($user) {
            return $user->hasRole('super_admin');
        });

        Gate::define('is-admin', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('manage-users', function ($user) {
            return $user->roles()
                ->whereIn('identifier', ['super_admin', 'admin','staff'])
                ->exists();
        });

        Gate::define('edit-users', function ($user) {
            return $user->roles()
                ->whereIn('identifier', ['super_admin', 'admin'])
                ->exists();
        });

        Gate::define('delete-users', function ($user) {
            return $user->roles()
                ->whereIn('identifier', ['super_admin'])
                ->exists();
        });
    }
}
