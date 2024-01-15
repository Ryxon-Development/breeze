<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\CouponPolicy;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('create-coupon', [CouponPolicy::class, 'create']);
        Gate::define('delete-coupon', [CouponPolicy::class, 'delete']);
        Gate::define('update-coupon', [CouponPolicy::class, 'update']);
        Gate::define('view-coupon', [CouponPolicy::class, 'view']);
        Gate::define('view-any-coupon', [CouponPolicy::class, 'viewAny']);
        $this->registerPolicies();
    }
}
