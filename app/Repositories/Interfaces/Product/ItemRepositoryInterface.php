<?php

namespace App\Repositories\Interfaces\Product;

interface ItemRepositoryInterface
{

    /**
     * This function for get a Item
     */
    public function getItem($id);

    /**
     * This function for get all of items
     */
    public function getItems();

    /**
     * This function for insert Item into table items
     */
    public function storeItem(array $data);

    /**
     * This function for update a Item data
     */
    public function updateItem(int $id, $data);

    /**
     * This function for update Item status
     */
    public function updateStatusItem(int $id, $active);

    /**
     * This function for search Item
     */
    public function searchItemData($data);

}