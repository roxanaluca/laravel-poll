<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Encryption\Encrypter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller {

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
        $decriptPassword = base64_decode($request->password);

        if (!$user || $decriptPassword != $user->password) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }
    
        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json(['token' => $token])->header('Content-Type', 'application/json');    
    }

    public function createVoteController() {

    }
}