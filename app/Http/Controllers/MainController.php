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
    


        public function home(){
           $Upcomingprojects = DB::table( 'project' )->where( 'project_status_id', '1' )->orderBy( 'id', 'Asc' )->limit(6)->get();
           $Progressprojects = DB::table( 'project' )->where( 'project_status_id', '2' )->orderBy( 'id', 'Asc' )->limit(6)->get();
           $Completedprojects = DB::table( 'project' )->where( 'project_status_id', '3' )->orderBy( 'id', 'Asc' )->limit(6)->get();
          return view( 'welcome', compact( 'Upcomingprojects','Progressprojects','Completedprojects' ) );
        }
    public function project($id) {
      $project = DB::table( 'project' )->where( 'id', $id )->first();
           $Upcomingprojects = DB::table( 'project' )->where( 'project_status_id', '1' )->orderBy( 'id', 'Asc' )->limit(6)->get();
           $Progressprojects = DB::table( 'project' )->where( 'project_status_id', '2' )->orderBy( 'id', 'Asc' )->limit(6)->get();
           $Completedprojects = DB::table( 'project' )->where( 'project_status_id', '3' )->orderBy( 'id', 'Asc' )->limit(6)->get();
        return view( 'project', compact( 'project','Upcomingprojects','Progressprojects','Completedprojects' ) );
    }

        public function about_us(){
           $Upcomingprojects = DB::table( 'project' )->where( 'project_status_id', '1' )->orderBy( 'id', 'Asc' )->limit(6)->get();
           $Progressprojects = DB::table( 'project' )->where( 'project_status_id', '2' )->orderBy( 'id', 'Asc' )->limit(6)->get();
           $Completedprojects = DB::table( 'project' )->where( 'project_status_id', '3' )->orderBy( 'id', 'Asc' )->limit(6)->get();
          return view( 'about', compact( 'Upcomingprojects','Progressprojects','Completedprojects' ) );

        }


        public function projects($id){
			
		   $products = DB::table( 'project' )->where( 'project_status_id', $id )->orderBy( 'id', 'Asc' )->paginate(16);
          $projecttype = DB::table( 'project_status' )->where( 'id', $id )->first();

        return view( 'projects', compact( 'products','projecttype' ) );
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
