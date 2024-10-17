<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
     public $webmenu;


	  public function boot()
    {
		
           $sql = "select * from categorys where parent_id = '0'";
           $webmenu = DB::select( DB::raw( $sql ) );
		   $webmenu = json_decode( json_encode( $webmenu ), true );
			foreach($webmenu as $key => $menu){
				$category_id=$menu["id"];
				$sql="select * from categorys where parent_id=$category_id order by id desc";
				$result=DB::select($sql);
				$webmenu[$key]["submenu"] = $result;
			}
			$this->webmenu = json_decode( json_encode( $webmenu ) );
	   //dd($this->webmenu);
               
        view()->composer('web/layouts.header', function($view) {
            $view->with(['webmenu' => $this->webmenu]);
        });

   $sql = "select * from categorys where parent_id = '0'";
           $webmenu = DB::select( DB::raw( $sql ) );
		   $webmenu = json_decode( json_encode( $webmenu ), true );
			foreach($webmenu as $key => $menu){
				$category_id=$menu["id"];
				$sql="select * from categorys where parent_id=$category_id order by id desc";
				$result=DB::select($sql);
				$webmenu[$key]["submenu"] = $result;
			}
			$this->webmenu = json_decode( json_encode( $webmenu ) );
	   //dd($this->webmenu);
               
        view()->composer('web/layouts.other_header', function($view) {
            $view->with(['webmenu' => $this->webmenu]);
        });
		
		}
		
}
