<?php

namespace App\Http\Controllers;
use App\Events\MosahebeAdded;
use App\Jobs\SendMailJob;
use App\Models\Mosahebe;
use App\Models\User;
use App\Notifications\MosahebeNotify;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Thomasjohnkane\Snooze\Traits\SnoozeNotifiable;
use Thomasjohnkane\Snooze\ScheduledNotification;
//use Illuminate\Support\Facades\Request;

class MosahebeController extends Controller
{
    //
    public function showall(){
        $mosahebes=Mosahebe::all();
        $mosahebesText="";
        foreach ($mosahebes as $mosahebe){
            $mosahebesText.="Mosahebe\n title:".$mosahebe->title."\n detail:".$mosahebe->detail."\n date:".$mosahebe->date."\n\n";
        }
        return $mosahebesText;
    }
    public function show ($id){
        $mosahebe=Mosahebe::find($id);
        return "Mosahebe\n title:".$mosahebe->title."\n detail:".$mosahebe->detail."\n date:".$mosahebe->date."\n";
    }
    public function create(Request $request){

//        echo var_dump($request);
        $request->validate([
            "title"=>"required|string",
//            "detail"=>"required|string|max:500",
            "detail"=>"required|string",
            "date"=>"required|date_format:H:i d/m/Y"
        ]);
        $mosahebe=new Mosahebe;
        $mosahebe->title=$request->title;
        $mosahebe->detail=$request->detail;
        $mosahebe->date=$request->date;
        $mosahebe->save();
//        $newjob=new SendMailJob($mosahebe);\
        $now=Carbon::now('Asia/Tehran')->getTimestamp();
        $mosahebeTime=Carbon::createFromFormat('H:i d/m/Y',$mosahebe->date,'Asia/Tehran')->subMinute(30)->getTimestamp();
//        echo Carbon::createFromFormat('H:i d/m/Y',$mosahebe->date,'Asia/Tehran')->subMinute(30);
//        echo Carbon::createFromFormat('H:i d/m/Y',$mosahebe->date,'Asia/Tehran');
        $timeToRunJob=intval(abs($now-$mosahebeTime)/60);
//        $timeToRunJob=$now->diff($mosahebeTime);
//        echo ($timeToRunJob);
//        $timeToRunJob=$timeToRunJob->format("%i");
//        echo $timeToRunJob;
        SendMailJob::dispatch($mosahebe)->delay(now('Asia/Tehran')->addMinute(intval($timeToRunJob)));
        echo "The Mosahebe data will be sent to your email 30 minutes before mosahebe time (run `php artisan queue:work` for that!)\n";
//        Auth::user()->notify(new SendMailJob($mosahebe))->delay([
//            'mail'
//        ]);
//        jobqueue_license_info();
        return response("mosahebe added successfully!",200);

    }
    public function update (Request $request,$id){
        $mosahebe=Mosahebe::find($id);
//        return $request;
        if ($request->title!=null) {
            $mosahebe->title = $request->title;
        }
        if ($request->detail!= null) {

            $mosahebe->detail = $request->detail;
        }
        if ($request->date!= null) {

            $mosahebe->date = $request->date;
        }
        $mosahebe->save();
        return response("mosahebe updated successfully!",200);

    }
    public function delete ($id){
        Mosahebe::find($id)->delete();
        response("mosahebe deleted successfully!",200);
    }
//    public function notifyUser(){
////        Auth::user()->notify(new MosahebeNotify());
////        $when = Carbon::now('Asia/Tehran')->addMinutes(1);
//        $mosahebe=Mosahebe::find(1);
////        Auth::user()->notify((new MosahebeNotify($mosahebe)));
//        ScheduledNotification::create(
//            User::find(1), // whom to sent
//            new MosahebeNotify( // custom notification
//                $mosahebe
//            ),
//            Carbon::now('Asia/Tehran')->addHour() // Send 15 min before appointment starts
//        );
//    }

}
