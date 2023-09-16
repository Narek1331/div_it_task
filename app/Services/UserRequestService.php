<?php
namespace App\Services;

use App\Models\UserRequest;
use App\Mail\UserRequestComment;
use Illuminate\Support\Facades\Mail;

class UserRequestService{

    /**
     * Create user request.
     */
    public function store($name, $email, $message){
        return UserRequest::create([
            'name' => $name,
            'email' => $email,
            'message' => $message
        ]);
    }

    /**
     * Edit user request.
     */
    public function edit($id,$comment){
        $user_request = UserRequest::findOrFail($id);

        $user_request->comment = $comment;
        $user_request->status = 'Resolved';

        $user_request->save();

        Mail::to($user_request->email)->send(new UserRequestComment($user_request));

        return $user_request;

    }

    /**
     * Get all user requests.
     */
    public function all($sort = null){

        $sort = $sort ? explode(":",$sort) : null;
        $sort = $sort && ($sort[0] == 'status' || $sort[0] == 'created_at')
        && ($sort[1] == 'asc' || $sort[1] == 'desc') ? $sort : null;

        $user_reqs = UserRequest::query();

        if($sort && count($sort) == 2){
            $user_reqs = $user_reqs->orderBy($sort[0],$sort[1]);
        }

        return $user_reqs->get();
    }
}

?>
