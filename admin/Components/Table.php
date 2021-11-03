<?php

namespace Admin\Components;

use Illuminate\View\Component;

class Table extends Component
{
   public $actions;
   public $columns;
   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct($columns = [])
   {
      $this->columns = $columns;
      $this->actions = [
         [

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
      return view('admin::components.table');
   }
}
