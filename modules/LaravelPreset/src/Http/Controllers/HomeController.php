<?php
namespace AkshayJumbade\Admin\Core\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class HomeController extends BaseController {
    function index() {
        return view('admin::index');
    }
}
