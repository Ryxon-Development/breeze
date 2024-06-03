<?php

namespace App\Policies;

use App\Models\Coupon;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CouponPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //disallow all as test
        return $user->id === 1;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Coupon $coupon): bool
    {
        //Allow all to view single coupons for now.
        return true;

        //Optionally add $coupon specific logic, for example:
        //return $user->id === $coupon->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //only user with id 1 can create coupons
        return $user->id === 1;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Coupon $coupon): bool
    {
        return $user->id === 1;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Coupon $coupon): bool
    {
        return $user->id === 1;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Coupon $coupon): bool
    {
        return $user->id === 1;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Coupon $coupon): bool
    {
        return $user->id === 1;
    }

    /**
     * Determine whether the user can activate the model.
     */
    public function activate(User $user, Coupon $coupon): bool
    {
        return $user->id === 1
            ? Response::allow()
            : Response::deny(__('You are not authorized to activate this coupon.'));
    }
}
