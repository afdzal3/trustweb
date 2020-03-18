<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\VerifyMail;
use App\User;
use App\Partner;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('guide');
    }

    function playground(){
      $lh = new \App\Api\V1\Controllers\LdapHelper;
      return $lh->fetchUser('S53788');

      return [
        'test' => \App\common\UserRegisterHandler::isInReportingLine(1, 48505)
        ];

      $ldate = new \Carbon\Carbon();
      if($ldate->dayOfWeek == 5){
        $ldate->subDay();
      }

      $cdate = new \Carbon\Carbon($ldate);
      $cdate->subDays($cdate->dayOfWeek)->subDays(2);

      $daterange = new \DatePeriod(
        $cdate,
        \DateInterval::createFromDateString('1 day'),
        (new \Carbon\Carbon($ldate))->addDay()
      );

      dd($ldate);

      $pd = [];
      foreach($daterange as $od){
        $pd[] = date_format($od, 'Y-m-d');
      }

      dd($pd);

      return \App\common\GDWActions::GetStaffAvgPerf(1, $cdate, $ldate);

    }

    function welcome(){
      return view('welcome');
    }

    function booking_faq(){
      return view('booking_faq');
    }

    public function listAdmins(){
      $adminlist = User::where('role', '<=', 2)->get();
      return view('adminlist', ['admins' => $adminlist]);
    }

    public function postreg(Request $req){
      return view('auth.verify', ['staff' => $req->staff]);
    }

    public function resend(Request $req){
      $user = User::findOrFail($req->staff);
      \Mail::to($user->email)->send(new VerifyMail($user));
      return view('auth.verify', ['staff' => $req->staff, 'resend' => true]);
    }

    public function mobregform(){
      $partn=Partner::all();
      return view('auth.mobreg', compact('partn'));
    }

    public function troll(){
      return view('troll');
    }

    public function info(){
      return redirect(route('app.list', [], false));

    }

}
