<?php

namespace App\Http\Controllers\Api;


use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\User;
use Jenssegers\Agent\Agent;

class UserController extends ApiController
{

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return $this->response(auth()->user());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAccountRequest $request)
    {
        $user = User::create($this->setUserDeviceInfo($request));

        return $this->response($user, true, 'Account Created', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request)
    {
        $user = auth()->user();
        $user->update($this->setUserDeviceInfo($request));
        return $this->response($user, true, 'Account Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }



    /**
     * Set User Device Info 
     * 
     * @param App\User
     * @return App\User
     */
    protected function setUserDeviceInfo($userData)
    {
        $agent = new Agent;
        $browser = $agent->browser();
        $platform = $agent->platform();

        $userData['user_agent'] = $browser . '-' . $agent->version($browser);
        $userData['user_os'] = $platform . '-' . $agent->version($platform);
        $userData['ip'] = request()->ip();

        return $userData->all();
    }
}
