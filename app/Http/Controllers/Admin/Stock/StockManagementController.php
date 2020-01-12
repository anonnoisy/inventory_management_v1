<?php

namespace App\Http\Controllers\Admin\Stock;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Stock\StockRepository;

class StockManagementController extends Controller
{

    protected $stock;

    /**
     * Class constructor.
     */
    public function __construct(StockRepository $stock)
    {
        $this->stock = $stock;
    }

    public function index()
    {
        $stocks = $this->stock->getProducts();
        return view('pages.admin.stocks.index', compact('stocks'));
    }

    public function create()
    {
        return view('pages.admin.stocks.create');
    }

    public function store(Request $request)
    {

    }

    public function stockIn(Request $request)
    {

    }

    public function stockOut(Request $request, $id)
    {

    }
}
