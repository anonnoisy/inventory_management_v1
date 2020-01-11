<?php

namespace App\Repositories\Interfaces\Product;

interface VendorRepositoryInterface
{

    /**
     * This function for get a Vendor by id
     */
    public function getVendor(int $id);

    /**
     * This function fot get all Vendors what user have
     */
    public function getVendors();

    /**
     * This function for create a new Vendor to insert into table Vendors
     */
    public function storeVendor($data);

    /**
     * This function for update a Vendor
     */
    public function updateVendor(int $id, $data);
    
    /**
     * This function for update a status Vendor
     */
    public function updateStatusVendor(int $id, int $active);

    /**
     * This function for search user data
     */
    public function searchVendorData(array $data);

}