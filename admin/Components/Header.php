<?php

namespace Admin\Components;

use Illuminate\View\Component;

class Header extends Component
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
      return view('admin::components.header');
   }
}
