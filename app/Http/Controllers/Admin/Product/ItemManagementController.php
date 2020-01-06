<?php

namespace App\Http\Controllers\Admin\Product;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BrandRepository;
use App\Repositories\Product\CategoryRepository;
use App\Repositories\Product\ItemRepository;
use App\Http\Requests\Item\StoreItemRequest;
use App\Http\Requests\Item\UpdateItemRequest;

class ItemManagementController extends Controller
{
    protected $item, $category, $brand;

    /**
     * Class constructor.
     */
    public function __construct(ItemRepository $item, CategoryRepository $category, BrandRepository $brand)
    {
        $this->middleware('auth');
        $this->item = $item;
        $this->category = $category;
        $this->brand = $brand;
    }

    /**
     * This function for show all the items
     */
    public function index()
    {
        $items = $this->item->getItems();
        return view('pages.admin.products.items.index', compact('items'));
    }

    /**
     * This function for show create item view
     */
    public function create()
    {
        $categories = $this->category->getCategories();
        $brands = $this->brand->getBrands();
        return view('pages.admin.products.items.create', compact('categories', 'brands'));
    }

    /**
     * This function for store some item intp items table
     */
    public function store(StoreItemRequest $request)
    {
        $item = $this->item->storeItem($request->all());

        if (! $item) {
            return redirect()->back()->with('status', 'Failed to create item');
        }

        return redirect()->route('admin::product-manage::item::home')->with('status', 'Successfully create an item');
    }

    /**
     * This function for show detail item or edit item
     */
    public function show($id)
    {
        $item = $this->item->getItem($id);
        $categories = $this->category->getCategories();
        $brands = $this->brand->getBrands();
        return view('pages.admin.products.items.show', compact('item', 'categories', 'brands'));
    }

    /**
     * This function for update item data
     */
    public function update($id, UpdateItemRequest $request)
    {
        $item = $this->item->updateItem($id, $request->all());

        if (! $item) {
            return redirect()->back()->with('status', 'Failed to update an Item');
        }

        return redirect()->route('admin::product-manage::item::home')->with('status', 'Successfully update an item');
    }

    /**
     * This function for delete an item
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }

    /**
     * This function for update status active or inactive items
     */
    public function status($id, Request $request)
    {
        $this->validate($request, ['active' => 'required']);

        if (! $this->item->updateStatusItem($id, $request->active)) {
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

        $items = $this->item->searchItemData($data);

        $search = $data['search'];
        return view('pages.admin.products.items.index', compact('items', 'search'));
    }

}
