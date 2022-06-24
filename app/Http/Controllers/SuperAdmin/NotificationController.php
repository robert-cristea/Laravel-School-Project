<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Notifications;
use App\Model\Notification_listing;
use App\Model\Corporate_clients;
use Illuminate\Support\Facades\Auth;
use App\User;

class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private  $current_model;
    public function __construct()
    {
        $this->middleware('auth');
        $this->current_model=new Notifications();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
       
        $notifications=$this->current_model->getNotifyList();     
        $users=User::all();
        $corporate_clients = Corporate_clients::all();
        return view('backend.superadmin.notification', compact(
            'notifications',
            'users',
            'corporate_clients'
        ));
    }
    //Adding Quotes
    public function addNotify(Request $request)
    {
        
        $req = $request->all();     
        $id = Auth::user()->id;
        $date=date('Y-m-d-H:i:s');        
        $inserted_id= Notifications::create([
            'notification_name' => $req['notification_name'],
            'content_frensh' => $req['content_frensh'],
            'content_english' => $req['content_english'],             
            'target' => $req['target'],
            'date'=>$date
        ])->id;
        Notification_listing::create([
            'notification_id'=>$inserted_id,
            'timestamp'=>$date,
            'status'=>0,
            'user_id'=>$id

        ]);

        $notification = array(
            'message' => 'Created successfuly', 
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function deleteNotify($id){
    
        Notifications::whereNotification_id($id)->delete();
        Notification_listing::whereNotification_id($id)->delete(); 

        $notification = array(
            'message' => 'Deleted successfuly', 
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
