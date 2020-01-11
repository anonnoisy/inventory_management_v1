<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Repositories\Customer\CustomerRepository;

class CustomerManagementController extends Controller
{
    protected $customer;

    /**
     * Class constructor.
     */
    public function __construct(CustomerRepository $customer)
    {
        $this->middleware('auth');
        $this->customer = $customer;
    }

    /**
     * This function for show all customers
     */
    public function index()
    {
        $customers = $this->customer->getCustomers();
        return view('pages.admin.customers.index', compact('customers'));
    }

    /**
     * This function for return view create customer form
     */
    public function create()
    {
        return view('pages.admin.customers.create');
    }

    /**
     * This function for insert customer data into customers table
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = $this->customer->storeCustomer($request->all());

        if (! $customer) {
            return redirect()->back()->with('status', $customer['message']);
        }

        return redirect()->route('admin::customer-manage::customer::home')->with('status', 'Successfully create an customer');
    }

    /**
     * This function for return view show or edit data customer
     */
    public function show($id)
    {
        $customer = $this->customer->getCustomer($id);
        return view('pages.admin.customers.show', compact('customer'));
    }

    /**
     * This function for update data customer
     */
    public function update($id, UpdateCustomerRequest $request)
    {
        $customer = $this->customer->updateCustomer($id, $request->all());

        if (! $customer) {
            return redirect()->back()->with('status', $customer['message']);
        }

        return redirect()->route('admin::customer-manage::customer::home')->with('status', 'Successfully update an customer');
    }

    /**
     * This function for soft deletes customer
     */
    public function destroy($id)
    {
        $customer = Customer::findOrfail($id);
        $customer->delete();
        return redirect()->back();
    }

    /**
     * This function for update status active or inactive customer
     */
    public function status($id, Request $request)
    {
        $this->validate($request, ['active' => 'required']);

        if (! $this->customer->updateStatusCustomer($id, $request->active)) {
            return redirect()->back()->with('status', 'Failed to change active status ' . $request->name);
        }

        $status = $request->active == 1 ? 'active' : 'inactive';

        return redirect()->route('admin::customer-manage::customer::home')->with('status', 'Successfully change this customer status to ' . $status);
    }

    /**
     * Funtion for search customer data by filter or input search
     */
    public function searchByFilter(Request $request)
    {
        $data['all'] = $request->has('all');
        $data['active'] = $request->has('active');
        $data['inactive'] = $request->has('inactive');
        $data['search'] = $request->search;

        $customers = $this->customer->searchCustomerData($data);

        $search = $data['search'];
        return view('pages.admin.customers.index', compact('customers', 'search'));
    }

}
