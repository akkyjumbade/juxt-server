<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Models\User;

class JWTAuthController extends Controller
{
   /**
    * Create a new AuthController instance.
    *
    * @return void
    */
   public function __construct()
   {
      $this->middleware('auth:api', ['except' => ['login', 'me']]);
   }

   /**
    * Get a JWT via given credentials.
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function login(LoginRequest $req)
   {
      $phone = $req->input('mobile_no');
      $credentials = [
         'username' => $phone,
      ];
      $tmpOtp = cache()->remember("tmp_otp_". $phone, 60 /2, function() {
         return rand(111111, 999999);
      });
      $msg = "Dear User, Your OTP for login is $tmpOtp Note: The OTP is valid for 30 mins only. Do not share the OTP with anyone.";

      try {
         // \Notification::send([ $phone ], new \App\Notifications\SMSNotification($msg, [
         //    'otp' => true,
         // ]));
      } catch (\Throwable $th) {
         //throw $th;
         return response()->error([
            'message' => "Unable to send OTP. " . $th->getMessage()
         ]);
      }

      $user = User::where([ 'phone' => $phone ])->first();
      if (!$user) {
         $errMsg = "User not found with given number";
         return response()->error([
            'message' => $errMsg
         ]);
         // throw new \App\Exceptions\UserNotFoundException($errMsg, 404);
      }
      auth('jwt')->login($user);
      $token = auth('jwt')->refresh();
      if (! $token ) {
         return response()->error([
            'error' => 'Unauthorized',
            'errors' => [
               'mobile_no' => 'Username or password is invalid.'
            ],
         ], 401);
      }

      $fcm_token = $req->input('fcm_token');
      $user = auth('jwt')->user();
      try {
         $user->addAttribute('fcm_token', $fcm_token, [
            'user_id' => $user->id
         ]);
      } catch (\Throwable $th) {
         //throw $th;
         \Log::error($th);
      }

      return $this->respondWithToken($token);
   }

   /**
    * Get the authenticated User.
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function me()
   {
      $user = auth('jwt')->user();
      if ($user) {
         // $user->with('address');
         $user->load('address');
         $customAttrs = $user->custom_attrs;
         return response()->success([
            'data' => array_merge($user->toArray(), [
               'attrs' => $customAttrs
            ]),
         ]);
      }
      return response()->error([
         'message' => "Invalid token or expired login",
      ]);
      // throw new \App\Exceptions\InvalidAuthTokenException("Invalid token or expired login.", 1);
   }

   /**
    * Log the user out (Invalidate the token).
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function logout()
   {
      auth('jwt')->logout();

      return response()->success(['message' => 'Successfully logged out']);
   }

   /**
    * Refresh a token.
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function refresh()
   {
      return $this->respondWithToken(auth('jwt')->refresh());
   }

   /**
    * Get the token array structure.
    *
    * @param  string $token
    *
    * @return \Illuminate\Http\JsonResponse
    */
   protected function respondWithToken($token)
   {
      $user = auth('jwt')->user();
      if($user) {
         $user->update([
            'last_login_at' => now()
         ]);
      }
      return response()->success([
         'data' => [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('jwt')->factory()->getTTL() * 60
         ]
      ]);
   }

   function update(UpdateProfileRequest $req) {
      $user = auth('jwt')->user();
      try {
         $user->first_name = $req->input('first_name', $user->first_name);
         $user->middle_name = $req->input('middle_name', $user->middle_name);
         $user->last_name = $req->input('last_name', $user->last_name);
         $user->email = $req->input('email', $user->email);
         $user->gender = $req->input('gender', $user->gender);
         $user->birth_date = $req->input('dob', $user->birth_date);
         $user->save();
         $msg = "Profile updated";
         return response()->success([
            'message' => $msg,
         ]);
      } catch (\Throwable $th) {
         //throw $th;
         return response()->error([
            'message' => $th->getMessage(),
         ]);
      }
   }
}
