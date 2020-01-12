<?php

namespace App\Repositories\Interfaces\Stock;

use App\Model\Item;

interface StockRepositoryInterface
{

    /**
     * This function for get product
     * 
     * @param Int id item or product
     * @return Item
     */
    public function getProduct($id) : Item;

    /**
     * This function for get all items or products what user have
     * 
     * @return Item
     */
    public function getProducts();

    /**
     * This function for get the quantity of item
     * 
     * @param Item item or product
     * @return Int quantity of product
     */
    public function getQuantityProduct(Item $item) : int;

    /**
     * This function for store an item or product
     * 
     * @param Array data item
     * @return Item
     */
    public function storeProduct(array $data) : Item;

    /**
     * This function for increase an quantity of item
     * 
     * @param Item
     * @param Int quantity of item
     */
    public function increaseQuantityProduct(Item $item, int $quantity);

    /**
     * This function for decrease an quantity of item
     * 
     * @param Item
     * @param Int quantity of item
     */
    public function decreaseQuantityProduct(Item $item, int $quantity);

}