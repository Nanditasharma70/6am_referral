<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

// class RegistrationController extends Controller
// {
//     public function showForm()
//     {
//         return view('register');
//     }

//     public function register(Request $request)
//     {
//         $validated = $request->validate([
//             'username' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users',
//             'password' => 'required|string|min:8|confirmed',
//             'referral_code' => 'nullable|string|max:255',
//         ]);

//         $user = User::create([
//             'username' => $validated['username'],
//             'email' => $validated['email'],
//             'password' => Hash::make($validated['password']),
//             'referral_code' => $validated['referral_code'] ?? null,
//         ]);

//         return redirect()->route('register.form')->with('status', 'Registration successful');
//     }
// }


// class RegistrationController extends Controller
// {
//     public function showForm()
//     {
//         return view('register');
//     }

//     public function register(Request $request)
//     {
//         $validated = $request->validate([
//             'username' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users',
//             'password' => 'required|string|min:8', // Removed 'confirmed' validation
//             'referral_code' => 'nullable|string|max:255|exists:users,referral_code',
//         ]);

//         $referrer = null;

//         if (!empty($validated['referral_code'])) {
//             $referrer = User::where('referral_code', $validated['referral_code'])->first();
//         }

//         $user = User::create([
//             'username' => $validated['username'],
//             'email' => $validated['email'],
//             'password' => Hash::make($validated['password']),
//             'referral_code' => $this->generateReferralCode(),
//             'referral_points' => 0, // Initial referral points
//         ]);

//         // Update referrer's referral points if a referrer exists
//         if ($referrer) {
//             $referrer->increment('referral_points', 10);
//         }

//         return redirect()->route('register.form')->with('status', 'Registration successful');
//     }

//     private function generateReferralCode()
//     {
//         return strtoupper(Str::random(8)); // Generate a random 8 character referral code
//     }
// }


// class RegistrationController extends Controller
// {
//     public function showForm()
//     {
//         return view('register');
//     }

//     public function register(Request $request)
//     {
//         $validated = $request->validate([
//             'username' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users',
//             'password' => 'required|string|min:8',
//             'referral_code' => 'nullable|string|max:255|exists:users,referral_code',
//         ]);

//         $referrer = null;
//         if (!empty($validated['referral_code'])) {
//             $referrer = User::where('referral_code', $validated['referral_code'])->first();
//         }

//         $user = User::create([
//             'username' => $validated['username'],
//             'email' => $validated['email'],
//             'password' => Hash::make($validated['password']),
//             'referral_code' => $this->generateReferralCode(),
//             'referral_points' => 0,
//             'referred_by' => $referrer ? $referrer->id : null,
//         ]);


//         if ($referrer) {
//             $this->distributeReferralPoints($referrer, 10, 1);
//         }

//         return redirect()->route('register.form')->with('status', 'Registration successful');
//     }

//     private function generateReferralCode()
//     {
//         return strtoupper(Str::random(8));
//     }

//     private function distributeReferralPoints($user, $points, $level)
//     {
//         if ($level > 5) {
//             return;
//         }

//         $user->increment('referral_points', $points);

//         if ($user->referrer) {
//             $this->distributeReferralPoints($user->referrer, $points, $level + 1);
//         }
//     }
// }


//! % distribution with amount

// class RegistrationController extends Controller
// {
//     public function showForm()
//     {
//         return view('register');
//     }

//     public function register(Request $request)
//     {
//         $validated = $request->validate([
//             'username' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users',
//             'password' => 'required|string|min:8',
//             'referral_code' => 'nullable|string|max:255|exists:users,referral_code',
//         ]);

//         $referrer = null;
//         if (!empty($validated['referral_code'])) {
//             $referrer = User::where('referral_code', $validated['referral_code'])->first();
//         }

//         $user = User::create([
//             'username' => $validated['username'],
//             'email' => $validated['email'],
//             'password' => Hash::make($validated['password']),
//             'referral_code' => $this->generateReferralCode(),
//         ]);

//         // Distribute 50% of the total margin amount among users
//         $totalMargin = 1000; // Example total margin amount; adjust as needed
//         $marginToDistribute = $totalMargin * 0.50; // 50% of total margin
//         $this->distributeMargin($marginToDistribute, $referrer);

//         return redirect()->route('register.form')->with('status', 'Registration successful');
//     }

//     private function generateReferralCode()
//     {
//         return strtoupper(Str::random(8));
//     }

//     private function distributeMargin($marginToDistribute, $referrer)
//     {
//         $percentages = [20, 15, 15, 10, 10, 10, 5, 5, 5, 5];
//         $levels = count($percentages);

//         $level = 0;
//         $remainingMargin = $marginToDistribute;

//         while ($referrer && $level < $levels) {
//             $percentage = $percentages[$level];
//             $marginForLevel = ($marginToDistribute * $percentage) / 100;

//             // If this is the last level, distribute the remaining margin
//             if ($level === $levels - 1) {
//                 $marginForLevel = $remainingMargin;
//             }

//             $referrer->increment('referral_points', $marginForLevel);
//             $remainingMargin -= $marginForLevel;

//             $referrer = $referrer->referrer; // Move to the next referrer
//             $level++;
//         }

//         // Handle any remaining margin, if necessary
//         if ($remainingMargin > 0) {
//             // Optionally log or handle remaining margin here
//         }
//     }
// }

//! % distribution
class RegistrationController extends Controller
{
    public function showForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'referral_code' => 'nullable|string|max:255|exists:users,referral_code',
        ]);

        $referrer = null;
        if (!empty($validated['referral_code'])) {
            $referrer = User::where('referral_code', $validated['referral_code'])->first();
        }

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'referral_code' => $this->generateReferralCode(),
            'referral_points' => 0,
            'referred_by' => $referrer ? $referrer->id : null,
        ]);

        if ($referrer) {
            // Retrieve profit margin (assuming it's stored in config or environment variable)
            $profitMargin = config('app.profit_margin', 100); // Default to 100 if not set
            $distributionAmount = ($profitMargin * 50) / 100; // Calculate 50% of the profit margin
            $this->distributeReferralPoints($referrer, $distributionAmount, 1); // Distribute points
        }

        return redirect()->route('register.form')->with('status', 'Registration successful');
    }

    private function generateReferralCode()
    {
        return strtoupper(Str::random(8));
    }

    private function distributeReferralPoints($user, $totalPoints, $level)
    {
        $percentages = [20, 15, 15, 10, 10, 10, 5, 5, 5, 5];

        if ($level > count($percentages)) {
            return;
        }

        $points = ($totalPoints * $percentages[$level - 1]) / 100;
        $user->increment('referral_points', $points);

        if ($user->referrer) {
            $this->distributeReferralPoints($user->referrer, $totalPoints, $level + 1);
        }
    }
}
