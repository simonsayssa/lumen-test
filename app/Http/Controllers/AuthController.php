<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth:api');
    }


    /**
     * Authenticate (Login)
     * @param Request $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required',
                'password' => 'required'
            ]);
            $user = User::where('email', $request->input('email'))->first();
            if (!is_null($user) && Hash::check($request->input('password'), $user->password)) {
                $apikey = base64_encode(generateToken(40));
                $token = new UserToken();
                $token->user_id = $user->id;
                $token->token = $apikey;
                $token->save();
                return api_json_response(['token' => $token->token]);
            } else {
                return api_json_response([], "Invalid Credentials", 401);
            }
        } catch (\Exception $e) {
            return api_json_response([], $e->getMessage(), 500);
        }
    }

    /**
     * Register
     * @param Request $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'mobile_number' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'gender' => 'in:male,female',
            'birthday' => 'date_format:"' . config('general.date_format') . '"|required|date',
        ]);
        $user = new User();
        $user->email = $request->input('email');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->mobile_number = $request->input('mobile_number');
        $user->gender = $request->input('gender');
        $user->password = Hash::make($request->input('password'));
        $user->birthday = dbDateParse($request->input('birthday'));
        $user->save();
        return api_json_response([
            "email" => $user->email,
        ],
            "You Have Registered Successfully");
    }
}
