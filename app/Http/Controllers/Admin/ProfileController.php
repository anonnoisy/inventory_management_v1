<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Http\Requests\UserRequest;

class ProfileController extends Controller
{

    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }

    public function index()
    {
        $user_profile_information = $this->user->getUserInformation(auth()->user()->id);

        return view('pages.admin.profiles.index', compact('user_profile_information'));
    }

    public function update(UserRequest $request)
    {
        $this->user->updateUser(auth()->user()->id, $request->all());

        return redirect()->back()->with('status', 'Successfully updates profile');
    }
}
