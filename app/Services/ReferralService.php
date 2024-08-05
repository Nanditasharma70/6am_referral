<?php

namespace App\Services;

use App\Models\Purchase;
use App\Models\ReferralEarning;
use App\Models\User;

class ReferralService
{
    public function handlePurchase(User $user, $amount)
    {
        // Create the purchase
        $purchase = Purchase::create([
            'user_id' => $user->id,
            'amount' => $amount,
        ]);

        // Calculate referral earnings
        $this->calculateReferralEarnings($user, $purchase, $amount);
    }

    protected function calculateReferralEarnings(User $user, Purchase $purchase, $amount, $level = 1)
    {
        if ($level > 10) {
            return;
        }

        $referrer = $user->referredBy;
        if ($referrer) {
            $earningAmount = $amount * 0.10; // 10% for simplicity
            ReferralEarning::create([
                'user_id' => $user->id,
                'referrer_id' => $referrer->id,
                'purchase_id' => $purchase->id,
                'earning_amount' => $earningAmount,
                'level' => $level,
            ]);

            // Recursively calculate for the next level
            $this->calculateReferralEarnings($referrer, $purchase, $amount, $level + 1);
        }
    }
}
