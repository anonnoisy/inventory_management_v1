<?php

namespace App\Repositories\Interfaces\Product;

interface CategoryRepositoryInterface
{

    /**
     * This function for get a category
     */
    public function getCategory($id);

    /**
     * This function for get all of categories
     */
    public function getCategories();

    /**
     * This function for insert category into table categories
     */
    public function storeCategory(array $data);

    /**
     * This function for update a category data
     */
    public function updateCategory(int $id, $data);

    /**
     * This function for update category status
     */
    public function updateStatusCategory(int $id, $active);

    /**
     * This function for search category
     */
    public function searchCategoryData($data);

}