<?php

namespace App\Http\Controllers\Admin\Product;

use App\Model\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Repositories\Product\CategoryRepository;
use Illuminate\Http\Request;

class CategoryManagementController extends Controller
{

    protected $category;

    /**
     * Class constructor.
     */
    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    /**
     * This function for return to index view
     */
    public function index()
    {
        $categories = $this->category->getCategories();
        return view('pages.admin.products.categories.index', compact('categories'));
    }

    /**
     * This function for show create view
     */
    public function create()
    {
        return view('pages.admin.products.categories.create');
    }

    /**
     * This function for store category into categories table
     */
    public function store(StoreCategoryRequest $request)
    {
        $request['user_parent_id'] = auth()->user()->id;
        $category = $this->category->storeCategory($request->all());

        if (! $category) {
            return redirect()->back()->with('status', 'Failed to create new category');
        }

        return redirect()->route('admin::product-manage::category::home')->with('status', 'Successfully create new category');
    }

    /**
     * This function for return show category
     */
    public function show($id)
    {
        $category = $this->category->getCategory($id);
        return view('pages.admin.products.categories.show', compact('category'));
    }

    /**
     * This function for update category data
     */
    public function update($id, StoreCategoryRequest $request)
    {
        $category = $this->category->updateCategory($id, $request->all());
        
        if (! $category) {
            return redirect()->back()->with('status', 'Failed to update this category');
        }

        return redirect()->route('admin::product-manage::category::home')->with('status', 'Successfully update a category');
    }

    /**
     * This function for update a status category
     */
    public function status($id, Request $request)
    {
        $this->validate($request, ['active' => 'required']);

        if (! $this->category->updateStatusCategory($id, $request->active)) {
            return redirect()->back()->with('status', 'Failed to update status category');
        }

        $status = $request->active == 1 ? 'active' : 'inactive';

        return redirect()->route('admin::product-manage::category::home')->with('status', 'Successfully update status category to ' . $status);
    }

    /**
     * This function for delete a category
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back();
    }

    /**
     * This function for search a category by filter or search input
     */
    public function searchByFilter(Request $request)
    {
        $data['all'] = $request->has('all');
        $data['active'] = $request->has('active');
        $data['inactive'] = $request->has('inactive');
        $data['search'] = $request->search;

        $categories = $this->category->searchCategoryData($data);

        $search = $data['search'];
        return view('pages.admin.products.categories.index', compact('categories', 'search'));
    }

}
