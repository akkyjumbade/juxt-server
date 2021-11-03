<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
   /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
   public function authorize()
   {
      return true;
   }

   /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
   public function rules()
   {
      return [
         'first_name' => [ 'nullable',  ],
         'middle_name' => [ 'nullable',  ],
         'last_name' => [ 'nullable',  ],
         'email' => [ 'nullable', 'email:rfc,dns', ],
         'dob' => [ 'nullable',  ],
         'address' => [ 'nullable',  ],
         'area' => [ 'nullable',  ],
         'pincode' => [ 'nullable',  ],
         'city' => [ 'nullable',  ],
         'state' => [ 'nullable',  ],
         'country' => [ 'nullable',  ],
         'gender' => [ 'nullable',  ],
         'last_blood_donor_date' => [ 'nullable',  ],
         'smoking' => [ 'nullable',  ],
         'alcohal' => [ 'nullable',  ],
         'veg_nonveg' => [ 'nullable',  ],
         'medial_history' => [ 'nullable',  ],
      ];
   }
}
