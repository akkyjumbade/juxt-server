<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PostRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $userID = auth('jwt')->id();
       $posts = PostRequirement::latest()->where('posted_by_user_id', $userID)->paginate(10);
       try {
          return response()->success($posts->toArray());
       } catch (\Throwable $th) {
          return response()->error([
             'message' => $th
          ]);
       }
    }

    function listPublic(Request $request) {
       $lat = $request->query('latitude');
       $lon = $request->query('longitude');
       $posts = PostRequirement::latest()->where('status', 'active')->paginate(10);
       try {
          return response()->success($posts->toArray());
       } catch (\Throwable $th) {
          return response()->error([
             'message' => $th
          ]);
       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $rule = Validator::make($request->all(), [
          'patient_name' => ['required'],
          'type' => ['required'],
          'age' => ['required', 'numeric'],
          'gender' => ['required'],
          'hospital_name' => ['required'],
          'area' => ['required'],
          'city' => ['required'],
          'state' => ['required'],
          'pincode' => ['required', 'digits:6'],
          'country' => ['required'],
          'contact_person_name' => ['required'],
          'contact_person_mobile' => ['required', 'digits:10'],
          'message' => ['nullable', 'max:200'],
          'unit' => ['nullable'],
          'unit_qty' => ['nullable'],
       ]);
       if ($rule->fails()) {
          return response()->error([
             'errors' => $rule->errors(),
             'message' => __('validation_failed')
          ]);
       }

       try {
          $post = PostRequirement::create([
             'patient_name' => $request->input('patient_name'),
             'type' => $request->input('type'),
             'age' => $request->input('age'),
             'gender' => $request->input('gender'),
             'hospital_name' => $request->input('hospital_name'),
             'address_line' => $request->input('area'),
             'city' => $request->input('city'),
             'postal_code' => $request->input('pincode'),
             'state' => $request->input('state'),
             'country' => $request->input('country'),
             'contact_person_name' => $request->input('contact_person_name'),
             'contact_person_mobile' => $request->input('contact_person_mobile'),
             'message' => $request->input('message'),
             'unit' => $request->input('unit'),
             'unit_qty' => $request->input('unit_qty'),
             'status' => $request->input('status', 'pending'),
             'latitude' => $request->input('latitude', ''),
             'longitude' => $request->input('longitude', ''),
             'blood_group' => $request->input('blood_group', ''),
             'posted_by_user_id' => auth('jwt')->id(),
          ]);
          return response()->success([
             'message' => __('Post requirement created'),
             'data' => $post,
          ]);
       } catch (\Throwable $th) {
          return response()->error([
             'message' => $th->getMessage()
          ]);
       }
    }

   public function accept(Request $request)
   {
      $request->validate([
         'post_id' => ['required'],
         'user_id' => ['required'],
      ]);
      try {
         $post = PostRequirement::findOrFail($request->post_id);
         $post->requests()->where([
            'user_id' => $request->user_id
         ])->update([
            'status' => 'accepted'
         ]);
         return response()->success([
            'message' => 'Request accepted'
         ]);
      } catch (\Throwable $th) {
         return response()->error([
            'message' => $th->getMessage()
         ]);
      }
   }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostRequirement  $postRequirement
     * @return \Illuminate\Http\Response
     */
    public function show($postRequirementID)
    {
       $postRequirement = PostRequirement::where('id', $postRequirementID)->with('creator:id,name,phone,avatar', 'requests')->firstOrFail();
        return response()->success([
           'data' => $postRequirement
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostRequirement  $postRequirement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostRequirement $postRequirement)
    {
       try {
          $postRequirement->update([
             'updated_at' => now()
          ]);
          return response()->success([
             'message' => __('Post updated')
          ]);
       } catch (\Throwable $th) {
          return response()->error([
             'message' => $th->getMessage()
          ]);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostRequirement  $postRequirement
     * @return \Illuminate\Http\Response
     */
    public function destroy($postRequirementID)
    {
       $postRequirement = PostRequirement::find($postRequirementID);
       if (!$postRequirement) {
          return response()->error([
             'message' => __('Post not found')
          ], 404);
       }
       try {
          $postRequirement->delete();
          return response()->success([
             'message' => __('Post deleted'),
             'data' => $postRequirement,
          ]);
       } catch (\Throwable $th) {
          return response()->error([
             'message' => $th->getMessage()
          ]);
       }
    }
}
