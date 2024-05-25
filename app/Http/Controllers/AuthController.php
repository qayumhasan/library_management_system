<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\Error;
use App\Traits\Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use Error, Helpers;

    /**
     * @param Request $request
     *
     * @return [type]
     */
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            $user = User::with('roles.permissions')
                ->where('email', $credentials['email'])
                ->first();
            if (
                !$user ||
                !Hash::check($credentials['password'], $user->password)
            ) {
                throw new \Exception(
                    'Error|Credentials doesn\'t match--403',
                    13333
                );
            }

            $request->session()->regenerate();
            Auth::loginUsingId($user->id, true);

            return response()->json($this->extractPermissionsFromUser($user));
        } catch (\Exception $error) {
            return $this->errorResponse($error);
        }
    }

    /**
     * @return [type]
     */
    public function varify()
    {
        if (!($id = Auth::id())) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }
        $user = User::with('roles.permissions')->find($id);

        return response()->json($this->extractPermissionsFromUser($user));
    }

    /**
     * @param Request $request
     *
     * @return [type]
     */
    public function logout(Request $request)
    {
        try {
            Auth::guard('web')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json(true);
        } catch (\Exception $error) {
            return $this->errorResponse($error);
        }
    }
}
