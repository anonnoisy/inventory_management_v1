<?php

namespace App\Repositories\Product;

use App\Model\Category;
use App\Generators\RandomNameGenerator;
use App\Repositories\Interfaces\Product\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{

    /**
     * This function for get a category
     */
    public function getCategory($id)
    {
        return Category::with('users')
                        ->where('user_parent_id', auth()->user()->id)
                        ->where('id', $id)
                        ->first();
    }

    /**
     * This function for get all of categories what the user have
     */
    public function getCategories()
    {
        return Category::with('users')
                        ->where('user_parent_id', auth()->user()->id)
                        ->orderBy('created_at', 'DESC')
                        ->paginate(10);
    }

    /**
     * This function for insert category into categories table
     */
    public function storeCategory(array $data)
    {
        if (empty($data['code_name'])) {
            $data['code_name'] = RandomNameGenerator::generateRandomCodeName("CAT", $data['name'], 5);
        }

        $data['active'] = 1;

        return Category::create($data);
    }

    /**
     * This function for update a category data
     */
    public function updateCategory(int $id, $data)
    {
        $data['code_name'] = RandomNameGenerator::generateRandomCodeName("CAT", $data['name'], 5);

        return Category::findOrFail($id)
                        ->update([
                            'name' => $data['name'],
                            'code_name' => $data['code_name'],
                        ]);
    }

    /**
     * This function for update a category status active or inactive
     */
    public function updateStatusCategory(int $id, $active)
    {
        $category = Category::where('id', $id)->first();
        return $category->update(['active' => $active]);
    }

    /**
     * This function for search a category data
     */
    public function searchCategoryData($data)
    {
        $brands = Category::where('user_parent_id', auth()->user()->id)
                        ->orderBy('created_at', 'DESC')
                        ->select('id', 'name', 'code_name', 'active', 'created_at');

        if ($data['all']) {
            return $this->getCategories();
        }

        if ($data['active']) {
            $brands->where('active', 1);
        }

        if ($data['inactive']) {
            $brands->where('active', 0);
        }

        if (! empty($data['search'])) {
            $brands->where('name', 'like', '%'. $data['search'] .'%')
                    ->orWhere('code_name', 'like', '%'. $data['search'] .'%');
        }

        return $brands->paginate(10);

    }

}