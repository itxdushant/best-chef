<?php
    use App\Message;
    function getMessages($user_id){
        $current_id = auth()->user()->id;
        $current_id = 225;

        $Message = Message::where('sender', $user_id)->where('receiver', $current_id)
                            ->orWhere('receiver', $user_id)->where('sender', $current_id)
                            ->orderBy('id', 'DESC')
                            ->first();
        // if( !empty($Message) ){
        //     return $Message;
        // }
    }
?>