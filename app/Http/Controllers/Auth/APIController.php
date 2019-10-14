<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SignupActivate;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Redirect;
use Response;

class APIController extends Controller
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'activation_token' => str_random(60)
        ]);

        //$user->notify(new SignupActivate($user));

        return response()->json([
            'message' => 'Account created',
            'user' => $user,
            'status' => 200,
        ]);
    }

    public function login(Request $request)
    {   
       // \Log::info($request->all());
       //Check if a user with the specified email exists
        $user = User::whereEmail(request('username'))->first();

        if (! $user) {

            //flash('Wrong email or password')->error();
            return response()->json([
                'message' => 'Wrong email',
                'status' => 422,
            ], 422);
        }
        //  If a user with the email was found - check if the specified password
        //  belongs to this user
        // */
        if (! \Hash::check(request('password'), $user->password)) {
            return response()->json([
                'message' => 'Wrong password',
                'status' => 422,
            ], 422);
        }


        $http = new \GuzzleHttp\Client;

        try {
            $response = $http->post(config('services.passport.login_endpoint'),[
              'form_params' => [
               'grant_type' => 'password',
               'client_id' => config('services.passport.client_id'),
               'client_secret' => config('services.passport.client_secret'),
               'username' => $request->username,
               'password' => $request->password,
           ]
         ]);

            if ( $response->getStatusCode() != 200) {
                return response()->json([
                     'message' => 'Wrong email or password',
                     'status' => 422,
                 ]);
            }

        $data = json_decode($response->getBody());

        // Format the final response in a desirable format
        return response()->json([
            'access_token' => $data->access_token,
            'user' => $user,
            'status' => 200,
        ]);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() === 400) {
                return response()->json('Invalid Request, Please enter a username or a password', $e->getCode());
            }else if ($e->getCode()===401) {
                return response()->json('Your Credentials are incorrect. Please try again'. $e->getCode());
            }

         return response()->json('Something went Wrong'. $e->getCode());

        }        
       
    }

    public function logout()
    {
        $accessToken = auth()->user()->token();
       \Log::info($accessToken);
        $refreshToken = \DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true,
            ]);

        $accessToken->revoke();

        return response()->json(['status' => 200]);
    }

    public function getUser()
    {
        return auth()->user();
    }

    public function signupActivate($token)
    {
        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
        $user->active = true;
        $user->activation_token = '';
        $user->save();
        return redirect('/');
    }
}
