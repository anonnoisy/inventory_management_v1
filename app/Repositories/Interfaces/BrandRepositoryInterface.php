<?php

namespace App\Repositories\Interfaces;

interface BrandRepositoryInterface
{

    /**
     * This function for get a brand by id
     */
    public function getBrandById(int $id);
    
    /**
     * This function for get a brand by id
     */
    public function getBrandByCodeName(string $code_name);

    /**
     * This function fot get all brands what user have
     */
    public function getBrands();

    /**
     * This function for generate random string
     */
    public function generateRandomCodeName(string $name);

    /**
     * This function for generate random code name of brand
     */
    public function generateRandomString(int $length = null);

    /**
     * This function for create a new brand to insert into table brands
     */
    public function storeBrand($data);

    /**
     * This function for update a brand
     */
    public function updateBrand(int $id, $data);
    
    /**
     * This function for update a status brand
     */
    public function updateStatusBrand(int $id, int $active);

    /**
     * This function for search user data
     */
    public function searchBrandData(array $data);

}