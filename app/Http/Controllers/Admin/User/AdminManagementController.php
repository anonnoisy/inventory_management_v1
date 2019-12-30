<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class AdminManagementController extends Controller
{

    protected $user;

    /**
     * Class constructor.
     */
    public function __construct(UserRepository $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }

    /**
     * Class index show all data user admin management
     */
    public function index()
    {
        // $users = $this->user->findUser('user_roles', 'Admin', true, 10);
        $users = $this->user->getUsers();
        return view('pages.admin.users.administrator.index')->with(compact('users'));
    }

    /**
     * Class for show form create new admin user data
     */
    public function create()
    {
        return view('pages.admin.users.administrator.create');
    }

    /**
     * Class for insert data to users table
     */
    public function store(UserRequest $request)
    {
        $data = (array) $request->all();
        $data['user_roles'] = 1;

        $this->user->storeUser($data);
        return redirect()->back()->with('status', 'Successfully create ' . $request->firstname . ' admin user.');
    }

}
