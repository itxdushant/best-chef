<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Message;


class ChatController extends Controller
{
    /*Get User Messages*/
    public function index(){
        $user_id = Auth::user()->id;
        //$messages = User::with('receiverChat', 'senderChat')->where('id', 253)->groupBy('id')->get();
        $messages = User::with('chats')->orderBy('id', 'asc')->paginate(10);

        $conversations = Message::where('sender', $user_id)
                    ->orWhere('receiver', $user_id ) 
                    ->orderBy('id', 'desc')->get();

        $userids = $conversations->map(function($conversation){
            $user_id = Auth::user()->id;
        if($conversation->sender === $user_id) {
            return $conversation->receiver;
        }
            return $conversation->sender;
        })->unique();

        $users = User::whereIn('id',$userids)->paginate(10);

        return view ('chef.messages',compact('users') );
    }


    /**
     * Display a listing of the resource.
     */
    public function getUserMessages(Request $request){
        $messages = [];
        if( isset($request->chef_id) ){ 
            $current_id = auth()->user()->id;
            //$current_id = 225;
            $messages = Message::where('sender', $request->chef_id)->where('receiver', $current_id)
                                ->orWhere('receiver', $request->chef_id)->where('sender', $current_id)->groupBy('created_at')->paginate(10);
        }
        return response()->json(['message' => $messages]);
    }

    /**
     * 
     * Send Message
     * 
    */

    public function send(Request $request){
        $validated = $request->validate([
            'chef_id' => 'required',
            'msg' => 'required'
        ]);

        $message = Message::create([
            'sender' => Auth()->user()->id,
            'receiver' => $request->chef_id,
            'message' => $request->msg,
            'media_ids' => $request->media_ids,
            'is_read' => 0
        ]);
        
        return response()->json(['message' => $message]);
    }

}
