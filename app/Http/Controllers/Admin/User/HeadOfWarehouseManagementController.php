<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\User;

class HeadOfWarehouseManagementController extends Controller
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
        $users = $this->user->getUsers(3);
        return view('pages.admin.users.head-of-warehouse.index')->with(compact('users'));
    }

    /**
     * Class for show form create new admin user data
     */
    public function create()
    {
        return view('pages.admin.users.head-of-warehouse.create');
    }

    /**
     * Class for insert data to users table
     */
    public function store(UserRequest $request)
    {
        $data = (array) $request->all();
        $data['user_roles'] = 3;
        $data['user_parent_id'] = auth()->user()->id;

        $this->user->storeUser($data);
        return redirect()->back()->with('status', 'Successfully create ' . $request->firstname . ' admin user.');
    }

    /**
     * Function for show edit/or detail admin user data
     */
    public function show($id)
    {
        $user = $this->user->getUser($id);
        return view('pages.admin.users.head-of-warehouse.show', compact('user'));
    }

    /**
     * Function for delete admin user data
     */
    public function destroy($id)
    {
        $user = $this->user->getUser($id);
        return view('pages.admin.users.head-of-warehouse.show', compact('user'));
    }

    /**
     * Function for update the active status of user
     */
    public function status($id, Request $request)
    {
        $this->validate($request, ['active' => 'required']);

        if (! $this->user->updateUserByStatus($id, $request->active)) {
            return redirect()->back()->with('status', 'Failed to change active status ' . $request->firstname);
        }

        $status = $request->active == 1 ? 'active' : 'inactive';

        return redirect()->back()->with('status', 'Successfully change this user status to ' . $status);
    }

    /**
     * Funtion for search user data by filter or input search
     */
    public function searchByFilter(Request $request)
    {
        $data['all'] = $request->has('all');
        $data['active'] = $request->has('active');
        $data['inactive'] = $request->has('inactive');
        $data['search'] = $request->search;
        $user_roles = 3;

        $users = $this->user->searchUserData($data, $user_roles);
        $search = $data['search'];
        return view('pages.admin.users.head-of-warehouse.index', compact('users', 'search'));
    }

}
