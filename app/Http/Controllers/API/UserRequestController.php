<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserRequestService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Validation\Rule;

class UserRequestController extends Controller
{
    /**
     * Create a new UserRequestService instance.
     *
     * @return void
     */
    public function __construct(UserRequestService $user_req_service)
    {
        $this->user_req_service = $user_req_service;
    }

     /**
     * Get user requests.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {

        $user_reqs = $this->user_req_service->all($request->sort);

        return response()->json([
            'status' => true,
            'datas' => $user_reqs
        ],201);

    }

    /**
     * Create user request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserRequest $request)
    {
        $user_req = $this->user_req_service->store($request['name'],$request['email'],$request['message']);

        return response()->json([
            'status' => true,
            'message' => 'Request saved successfully'
        ],201);

    }

    /**
     * Edit user request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(EditUserRequest $request,int $id)
    {

        $user_req = $this->user_req_service->edit($id,$request['comment']);

        return response()->json([
            'status' => true,
            'data' => $user_req,
            'message' => 'Request edited successfully'
        ],201);

    }
}
