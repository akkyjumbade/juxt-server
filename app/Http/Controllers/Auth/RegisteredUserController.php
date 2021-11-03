<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
   use \App\Traits\UserTrait;
   /**
    * Display the registration view.
    *
    * @return \Illuminate\View\View
    */
   public function create()
   {
      return view('auth.register');
   }
   function rules() {
      return [
         'first_name' => ['required', 'string', 'max:255'],
         'middle_name' => ['nullable', 'string', 'max:255'],
         'last_name' => ['nullable', 'string', 'max:255'],
         'phone' => ['required', 'string', 'max:12', 'unique:users'],
         'username' => ['nullable', 'string', 'max:255', 'unique:users'],
         'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
         'password' => ['nullable', 'min:6', 'max:20'],
         'dob' => ['nullable', 'string', 'max:255', ],
         // Address details
         'address' => ['nullable', 'string', 'max:255', ],
         'address_2' => ['nullable', 'string', 'max:255', ],
         'postal_code' => ['nullable', 'string', 'max:255', ],
         'city' => ['nullable', 'string', 'max:255', ],
         'state' => ['nullable', 'string', 'max:255', ],
         'country' => ['nullable', 'string', 'max:255', ],
         // Bio
         'gender' => ['nullable', 'string', 'max:255', ],
         'last_blood_donor_date' => ['nullable', 'string', 'max:255', ],
         'smoking' => ['nullable', 'string', 'max:255', ],
         'alcohal' => ['nullable', 'string', 'max:255', ],
         'veg_nonveg' => ['nullable', 'string', 'max:255', ],
         'medial_history' => ['nullable', 'string', 'max:255', ],
         'blood_group' => ['nullable', 'string', 'max:255', ],
         // Token
         'push_notification_token' => ['nullable', 'string', ],
      ];
   }
   /**
    * Handle an incoming registration request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\RedirectResponse
    *
    * @throws \Illuminate\Validation\ValidationException
    */
   public function store(Request $request)
   {
      $request->validate($this->rules());
      \DB::beginTransaction();
      try {
         $user = User::create([
            'name' => $request->first_name,
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'gender' => $request->input('gender'),
            'birth_date' => $request->input('dob'),
            'email' => $request->input('email', ''),
            'phone' => $request->input('phone', ''),
            'username' => $request->input('username', ''),
            'password' => Hash::make($request->input('phone', '')),
         ]);
      } catch (\Throwable $th) {
         throw $th;
      }
      try {
         $user->address()->create([
            'name' => $request->input('first_name'),
            'address_line' => $request->input('address'),
            'address_line_2' => $request->input('address_2'),
            'city' => $request->input('city'),
            'province' => $request->input('state'),
            'postal_code' => $request->input('postal_code'),
            'country' => $request->input('country', 'IN'),
         ]);
      } catch (\Throwable $th) {
         // throw $th;
         return response()->error([
            'message' => $th->getMessage()
         ]);
         // DB::rollBack();
      }
      // Store attrs
      try {
         $user->addAttribute('last_blood_donor_date', $request->input('last_blood_donor_date'));
         $user->addAttribute('smoking', $request->input('smoking'));
         $user->addAttribute('alcohal', $request->input('alcohal'));
         $user->addAttribute('veg_nonveg', $request->input('veg_nonveg'));
         $user->addAttribute('medial_history', $request->input('medial_history'));
         $user->addAttribute('fcm_token', $request->input('fcm_token'));
         $user->addAttribute('blood_group', $request->input('blood_group'));
      } catch (\Throwable $th) {
         // throw $th;
         return response()->error([
            'message' => $th->getMessage()
         ]);
      }
      \DB::commit();
      event(new Registered($user));
      $token = null;
      if ($user) {
         $user->load('address');
         $token = auth('jwt')->login($user);
      }
      // Auth::login($user);

      if ($request->header('Accept') == 'application/json') {
         return $this->sendUserInfo([
            'message' => 'Registration successful.'
         ]);
      }
      return redirect(RouteServiceProvider::HOME);
   }
}
