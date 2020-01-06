<?php

namespace App\Http\Controllers\Admin\Product;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\StoreBrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Repositories\BrandRepository;
use App\Repositories\Product\CategoryRepository;
use App\User;
use Illuminate\Http\Request;

class BrandManagementController extends Controller
{

    protected $brand;
    protected $category;

    public function __construct(BrandRepository $brand, CategoryRepository $category)
    {
        $this->middleware('auth');
        $this->brand = $brand;
        $this->category = $category;
    }

    /**
     * Function to return brands index page
     */
    public function index()
    {
        $brands = $this->brand->getBrands();
        return view('pages.admin.products.brands.index', compact('brands'));
    }

    /**
     * Function to return create brand view
     */
    public function create()
    {
        $categories = $this->category->getCategories();
        return view('pages.admin.products.brands.create', compact('categories'));
    }
    
    /**
     * Function to return insert brand to database
     */
    public function store(StoreBrandRequest $request)
    {
        $brand = $this->brand->storeBrand($request->all());

        if (! $brand) {
            return redirect()->back()->with('status', 'Failed to created new brand');
        }

        return redirect()->route('admin::product-manage::brand::home')->with('status', 'Successfully to created new brand');
    }

    /**
     * Function for show edit/or detail brand data
     */
    public function show($id)
    {
        $brand = $this->brand->getBrand($id);
        return view('pages.admin.products.brands.show', compact('brand'));
    }

    /**
     * Function for show edit/or detail brand data
     */
    public function update($id, UpdateBrandRequest $request)
    {
        $request->validated();

        $brand = $this->brand->updateBrand($id, $request->all());

        if (! $brand) {
            return redirect()->back()->with('status', 'Failed to update a brand');
        }

        return redirect()->route('admin::product-manage::brand::home')->with('status', 'Successfully to update a brand');
    }

    /**
     * Function for delete brand data
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return redirect()->back();        
    }

    /**
     * Function for update the active status of brand
     */
    public function status($id, Request $request)
    {
        $this->validate($request, ['active' => 'required']);

        if (! $this->brand->updateStatusBrand($id, $request->active)) {
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

        $brands = $this->brand->searchBrandData($data);

        $search = $data['search'];
        return view('pages.admin.products.brands.index', compact('brands', 'search'));
    }

}
