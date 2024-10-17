<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\User;
use Jenssegers\Agent\Agent;
use App\FCM;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'auth' );
    }

    public function dashboard() {
	
    return view( 'admin/dashboard');
    }
}
