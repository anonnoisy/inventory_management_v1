<?php

namespace App\Repositories\Stock;

use App\Model\Item;
use App\Generators\RandomNameGenerator;
use App\Repositories\Interfaces\Stock\StockRepositoryInterface;

class StockRepository implements StockRepositoryInterface
{

    /**
     * This function for get product
     * 
     * @param Int id item or product
     * @return Item
     */
    public function getProduct($id) : Item
    {
        return Item::with(['users', 'brands', 'categories'])
                    ->where('user_parent_id', auth()->user()->id)
                    ->where('id', $id)
                    ->first();
    }

    /**
     * This function for get all items or products what user have
     * 
     * @return Item
     */
    public function getProducts()
    {
        return Item::with(['users', 'brands', 'categories'])
                    ->where('user_parent_id', auth()->user()->id)
                    ->paginate(10);
    }

    /**
     * This function for get the quantity of item
     * 
     * @param Item item or product
     * @return Int quantity of product
     */
    public function getQuantityProduct(Item $item) : int
    {
        $quantity = $item->select('quantity')->first();
        return $quantity->quantity;
    }

    /**
     * This function for store an item or product
     * 
     * @param Array data item
     * @return Item
     */
    public function storeProduct(array $data) : Item
    {

        $data['user_parent_id'] = auth()->user()->id;

        if (empty($data['code_name'])) {
            $data['code_name'] = RandomNameGenerator::generateRandomCodeName("ITM", $data['name'], 5);
        }

        return Item::create($data);

    }

    /**
     * This function for increase an quantity of item
     * 
     * @param Item
     * @param Int quantity of item
     */
    public function increaseQuantityProduct(Item $item, int $quantity)
    {
        $getQuantity = $this->getQuantityProduct($item);
        $getQuantity += $quantity;

        return $item->update(['quantity' => $getQuantity]);
    }

    /**
     * This function for decrease an quantity of item
     * 
     * @param Item
     * @param Int quantity of item
     */
    public function decreaseQuantityProduct(Item $item, int $quantity)
    {
        $getQuantity = $this->getQuantityProduct($item);
        $getQuantity -= $quantity;

        return $item->update(['quantity' => $getQuantity]);
    }

}