<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Requests\UpdateProfilePhotoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;


class ProfileController extends Controller
{
   use \App\Traits\UserTrait;
   function update(UpdateProfileRequest $req) {
      $user = auth('jwt')->user();
      if (!$user) {
         return response()->error([
            'message' => 'User not found'
         ], 404);
      }
      try {
         $user->first_name = $req->input('first_name', $user->first_name);
         $user->name = $req->input('first_name', $user->first_name);
         $user->middle_name = $req->input('middle_name', $user->middle_name);
         $user->last_name = $req->input('last_name', $user->last_name);
         $user->email = $req->input('email', $user->email);
         $user->gender = $req->input('gender', $user->gender);
         $user->birth_date = $req->input('dob', $user->birth_date);
         $user->save();
         try {
            $user->address()->update([
               'address_line' => $req->input('address'),
               'address_line_2' => $req->input('area'),
               'city' => $req->input('city'),
               'state' => $req->input('state'),
               'postal_code' => $req->input('pincode'),
               'country' => $req->input('country'),
            ]);
         } catch (\Throwable $th) {
            \Log::error("Unable to update the user's address, ");
            \Log::error($th);
         }
         // Update the user properties
         try {
            $user->addAttribute('last_blood_donor_date', $req->input('last_blood_donor_date'));
            $user->addAttribute('smoking', $req->input('smoking'));
            $user->addAttribute('alcohal', $req->input('alcohal'));
            $user->addAttribute('veg_nonveg', $req->input('veg_nonveg'));
            $user->addAttribute('medial_history', $req->input('medial_history'));
         } catch (\Throwable $th) {
            \Log::error("Unable to update the user's address, ");
            \Log::error($th);
         }

         $msg = "Profile updated";
         return $this->sendUserInfo([
            'message' => $msg,
         ]);
      } catch (\Throwable $th) {
         // throw $th;
         return response()->error([
            'message' => $th->getMessage(),
         ]);
      }
   }

   function updateProfilePhoto(Request $req) {
      $user = auth('jwt')->user();
      try {
         $path = Storage::putFile('public/avatars', $req->file('photo'));
         $user->avatar = Storage::url($path);
         $user->save();
         $msg = "Profile photo updated";
         return response()->success([
            'message' => $msg,
            'profile_photo_url' => $user->avatar,
            'data' => [
               'profile_photo_url' => $user->avatar,
               'absolute_url' => url($user->avatar),
            ]
         ]);
      } catch (\Throwable $th) {
         throw $th;
         return response()->error([
            'message' => $th->getMessage(),
         ]);
      }
   }

   function notifications(Request $req) {
      try {
         $user = auth('jwt')->user();
         $notifications = $user->notifications()->latest()->get()->toArray();
         return response()->success([
            'data' => $notifications
         ]);
      } catch (\Throwable $th) {
         return response()->error([
            'message' => $th->getMessage(),
         ]);
      }
   }

   function markAsReadNotification(Request $req) {
      try {
         $user = auth('jwt')->user();
         $isMarked = $user->unreadNotifications()->whereIn('id', [$req->input('notification_id')])->update(['read_at' => now()]);

         return response()->success([
            'is_marked' => boolval($isMarked),
            'message' => "Marked as read."
         ]);
      } catch (\Throwable $th) {
         return response()->error([
            'message' => $th->getMessage(),
         ]);
      }
   }

   function updateAddress(Request $req) {
      $rule = Validator::make($req->all(), [
         'address_line' => ['required']
      ]);
      if ($rule->fails()) {
         return response()->error([
            'message' => __('Failed validation.'),
            'errors' => $rule->errors()
         ]);
      }
      $user = auth('jwt')->user();
      $preAddr = $user->address;

      try {
         $preAddr->name = $req->input('address_line', $user->name);
         $preAddr->address_line = $req->input('address_line', $preAddr->address_line ?? '');
         $preAddr->address_line_2 = $req->input('address_line_2', $preAddr->address_line_2 ?? '');
         $preAddr->city = $req->input('city', $preAddr->city ?? '');
         $preAddr->state = $req->input('state', $preAddr->state ?? '');
         $preAddr->postal_code = $req->input('postal_code', $preAddr->postal_code ?? '');
         $preAddr->country = $req->input('country', $preAddr->country ?? '');
         $preAddr->save();
         return response()->success([
            'message' => __('address.saved'),
            'data' => $preAddr
         ]);
      } catch (\Throwable $th) {
         return response()->error([
            'message' => $th->getMessage(),
         ]);
      }

   }
}
