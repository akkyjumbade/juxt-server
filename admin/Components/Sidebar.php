<?php

namespace Admin\Components;

use Illuminate\View\Component;

class Sidebar extends Component
{
   public $menus;
   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct()
   {
      $this->menus = [
         [
            'label' => 'Users',
            'to' => route('admin.users.index')
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
      return view('admin::components.sidebar');
   }
}
