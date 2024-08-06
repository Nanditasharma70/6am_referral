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
            $this->distributeReferralPoints($referrer, 10, 1);
        }

        return redirect()->route('register.form')->with('status', 'Registration successful');
    }

    private function generateReferralCode()
    {
        return strtoupper(Str::random(8));
    }

    private function distributeReferralPoints($user, $points, $level)
    {
        if ($level > 5) {
            return;
        }

        $user->increment('referral_points', $points);

        if ($user->referrer) {
            $this->distributeReferralPoints($user->referrer, $points, $level + 1);
        }
    }
}
