<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ReferralService;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    protected $referralService;

    public function __construct(ReferralService $referralService)
    {
        $this->referralService = $referralService;
    }

    public function store(Request $request)
    {
        $user = User::find($request->user_id);
        $amount = $request->amount;

        $this->referralService->handlePurchase($user, $amount);

        return response()->json(['message' => 'Purchase handled successfully']);
    }
}
