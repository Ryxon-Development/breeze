<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;

class CouponController extends Controller
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'error' => $validator->errors(),
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::all();
        return response()->json([
            'coupons' => $coupons,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCouponRequest $request)
    {
        return response()->json([
            'message' => 'Coupon created successfully',
            'coupon' => Coupon::create($request->all())
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        return response()->json([
            'coupon' => $coupon,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        //only update coupon values that are passed in request
        $coupon->update($request->all());

        return response()->json([
            'message' => 'Coupon updated successfully',
            'coupon' => $coupon,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        //
    }

    public function activate(Coupon $coupon)
    {
        $coupon->active = 1;
        $coupon->save();
        return response()->json([
            'message' => 'Coupon activated successfully',
            'coupon' => $coupon,
        ], 200);
    }
}
