<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Item\StoreItemRequest;
use App\Repositories\BrandRepository;
use App\Repositories\Product\CategoryRepository;
use App\Repositories\Product\ItemRepository;

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

}
