<?php

namespace Admin\Components;

use Illuminate\View\Component;

class Admin extends Component
{
   public $layoutData;
   public $primaryMenu;
   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct()
   {
      $user = auth()->user();
      $this->layoutData = [
         'baseURL' => url(''),
         'apiURL' => url('/api'),
         'csrfToken' => csrf_token(),
         'user' => [
            'uuid' => $user->uuid ?? '',
            'username' => $user->username ?? '',
            'email' => $user->email ?? '',
            'role' => $user->role->code ?? '',
            'avatar' => $user->role->avatar ?? '',
            'accessToken' => auth('jwt')->user()
         ],
      ];
      $this->primaryMenu = [
         [
            'label' => 'Dashboard',
            'to' => url('/dashboard')
         ]
      ];
   }

   /**
    * Get the view / contents that represent the component.
    *
    * @return \Illuminate\Contracts\View\View|\Closure|string
    */
   public function render()
   {
      return view('admin::layouts.admin');
   }
}
