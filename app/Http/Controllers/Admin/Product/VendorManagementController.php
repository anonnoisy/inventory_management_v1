<?php

namespace App\Http\Controllers\Admin\Product;

use App\Model\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\VendorRequest;
use App\Repositories\Product\VendorRepository;

class VendorManagementController extends Controller
{

    protected $vendor;
    protected $category;

    public function __construct(VendorRepository $vendor)
    {
        $this->middleware('auth');
        $this->vendor = $vendor;
    }

    /**
     * Function to return vendors index page
     */
    public function index()
    {
        $vendors = $this->vendor->getVendors();
        return view('pages.admin.products.vendors.index', compact('vendors'));
    }

    /**
     * Function to return create vendor view
     */
    public function create()
    {
        return view('pages.admin.products.vendors.create');
    }
    
    /**
     * Function to return insert vendor to database
     */
    public function store(VendorRequest $request)
    {
        $vendor = $this->vendor->storeVendor($request->all());

        if (! $vendor) {
            return redirect()->back()->with('status', 'Failed to created new vendor');
        }

        return redirect()->route('admin::product-manage::vendor::home')->with('status', 'Successfully to created new vendor');
    }

    /**
     * Function for show edit/or detail vendor data
     */
    public function show($id)
    {
        $vendor = $this->vendor->getVendor($id);
        return view('pages.admin.products.vendors.show', compact('vendor'));
    }

    /**
     * Function for show edit/or detail vendor data
     */
    public function update($id, VendorRequest $request)
    {
        $vendor = $this->vendor->updateVendor($id, $request->all());

        if (! $vendor) {
            return redirect()->back()->with('status', 'Failed to update a vendor');
        }

        return redirect()->route('admin::product-manage::vendor::home')->with('status', 'Successfully to update a vendor');
    }

    /**
     * Function for delete vendor data
     */
    public function destroy($id)
    {
        $vendor = vendor::findOrFail($id);
        $vendor->delete();
        return redirect()->back();        
    }

    /**
     * Function for update the active status of vendor
     */
    public function status($id, Request $request)
    {
        $this->validate($request, ['active' => 'required']);

        if (! $this->vendor->updateStatusVendor($id, $request->active)) {
            return redirect()->back()->with('status', 'Failed to change active status ' . $request->name);
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

        $vendors = $this->vendor->searchVendorData($data);

        $search = $data['search'];
        return view('pages.admin.products.vendors.index', compact('vendors', 'search'));
    }

}
