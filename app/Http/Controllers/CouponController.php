<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    //any failed validation will return json response
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
        return response()->json([
            'coupons' => Coupon::all(),
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //show coupon create form
        return view('coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCouponRequest $request)
    {
        //create coupon
        $coupon = Coupon::create($request->all());

        return response()->json([
            'message' => 'Coupon created successfully',
            'coupon' => $coupon,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Coupon $coupon)
    {
        //check if user is authorized to view coupon
        //cant use policy in route because $coupon is required, and cant be passed in route
        $this->authorize('view', $coupon);

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
