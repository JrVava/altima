<?php

namespace App\Http\Controllers;

use App\Models\Frame;
use App\Models\User;
use App\Models\UserDetail;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $users = User::with('userDetail')->get();
        $totalUsers = User::count();
        $usersWithDetails = User::has('userDetail')->count();
        $usersWithoutDetails = $totalUsers - $usersWithDetails;
        $downloaded = User::where('downloaded','=',true)->count();

        $frame1 = Frame::where('right','=',1)->first();
        $frame2 = Frame::where('right','=',2)->first();
        $frame3 = Frame::where('right','=',3)->first();

        $userDetailWithFrame1Count = UserDetail::where('frame_id','=',$frame1->id)->count();
        $userDetailWithFrame2Count = UserDetail::where('frame_id','=',$frame2->id)->count();
        $userDetailWithFrame3Count = UserDetail::where('frame_id','=',$frame3->id)->count();

        // dd($userDetailWithFrame1Count,$userDetailWithFrame2Count,$userDetailWithFrame3Count);
  
        // dd($frameOneCount, $frameTwoCount, $frameThreeCount,$userFrameCounts);
        return view("dashboard",compact(
            'users',
            'totalUsers',
            'usersWithDetails',
            'usersWithoutDetails',
            'downloaded',
            'userDetailWithFrame1Count',
            'userDetailWithFrame2Count',
            'userDetailWithFrame3Count'
        ));
    }
}
