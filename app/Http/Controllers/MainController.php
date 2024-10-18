<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Config;


use App\Models\Core\Setting;
use App\Models\Admin\Admin;
use App\Models\Core\Order;
use App\Models\Core\Customers;
use App\Models\Core\Drivers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Exception;
use App\Models\Core\Images;
use Validator;
use ZipArchive;
use File;
use Carbon\Carbon;
use DateTime;
use Carbon\CarbonPeriod;
use PDF;
use DateInterval;

class MainController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


        public function welcome(){
			
            return view("welcome");

        }

        public function home (){
			
            return view("welcome");

        }

        public function about_us(){
			
            return view("about");

        }


        public function projects(){
			
            return view("projects");

        }

        public function testimonial(){
			
            return view("testimonial");

        }

        public function contactus(){
			
            return view("contact");

        }
        public function gallery(){
			
            return view("gallery");

        }
        public function faq(){
			
            return view("faq");

        }
   

		public function blog(){
			
			return view("blog");

		}
		public function admin(){
			
			return view("admin/login");

		}
}
