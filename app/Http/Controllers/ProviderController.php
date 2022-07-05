<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProvierRequest;
use App\Http\Requests\UpdateProvierRequest;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::with('user')->get();

        return $providers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProvierRequest $request)
    {
        $validated = $request->validated();
        
        $user = User::create($validated);

        $user->provider()->create($validated);

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProvierRequest $request, $id)
    {
        $validated = $request->validated();
        $user = User::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
        ]);
        $provider = Provider::where('user_id',$id)->update([
            'nif' => $request->nif,
            'nis' => $request->nis,
        ]);
        return $provider;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $provider = User::where('id',$id)->delete();
        return $provider;
    }
}
