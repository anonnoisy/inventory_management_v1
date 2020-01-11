<?php

namespace App\Repositories\Product;

use App\Item;
use App\Generators\RandomNameGenerator;
use App\Repositories\Interfaces\Product\ItemRepositoryInterface;

class ItemRepository implements ItemRepositoryInterface
{

    /**
     * This function for get a Item
     */
    public function getItem($id)
    {
        return Item::where('user_parent_id', auth()->user()->id)
                        ->with(['users', 'categories', 'brands'])
                        ->where('id', $id)
                        ->first();
    }

    /**
     * This function for get all of categories what the user have
     */
    public function getItems()
    {
        return Item::where('user_parent_id', auth()->user()->id)
                        ->with(['users'])
                        ->orderBy('created_at', 'DESC')
                        ->paginate(10);
    }

    /**
     * This function for insert Item into categories table
     */
    public function storeItem(array $data)
    {
        if (empty($data['code_name'])) {
            $data['code_name'] = RandomNameGenerator::generateRandomCodeName("ITM", $data['name'], 5);
        }

        $data['active'] = 1;
        $data['user_parent_id'] = auth()->user()->id;

        return Item::create($data);
    }

    /**
     * This function for update a Item data
     */
    public function updateItem(int $id, $data)
    {
        $data['code_name'] = RandomNameGenerator::generateRandomCodeName("ITM", $data['name'], 5);

        return Item::findOrFail($id)
                        ->update([
                            'category_id' => $data['category_id'],
                            'brand_id' => $data['brand_id'],
                            'name' => $data['name'],
                            'code_name' => $data['code_name'],
                            'price' => $data['price'],
                            'quantity' => $data['quantity'],
                            'description' => $data['description'],
                        ]);
    }

    /**
     * This function for update a Item status active or inactive
     */
    public function updateStatusItem(int $id, $active)
    {
        $item = Item::where('id', $id)->first();
        return $item->update(['active' => $active]);
    }

    /**
     * This function for search a Item data
     */
    public function searchItemData($data)
    {
        $items = Item::where('user_parent_id', auth()->user()->id)
                        ->orderBy('created_at', 'DESC')
                        ->select('id', 'name', 'code_name', 'price', 'active', 'created_at');

        if ($data['all']) {
            return $this->getItems();
        }

        if ($data['active']) {
            $items->where('active', 1);
        }

        if ($data['inactive']) {
            $items->where('active', 0);
        }

        if (! empty($data['search'])) {
            $items->where('name', 'like', '%'. $data['search'] .'%')
                    ->orWhere('code_name', 'like', '%'. $data['search'] .'%');
        }

        return $items->paginate(10);

    }

}