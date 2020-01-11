<?php

namespace App\Repositories\Product;

use App\Model\Vendor;
use App\Generators\RandomNameGenerator;
use App\Repositories\Interfaces\Product\VendorRepositoryInterface;

class VendorRepository implements VendorRepositoryInterface
{

    /**
     * This function for get a vendor by id
     * 
     * @param Int id vendor
     */
    public function getVendor(int $id)
    {
        return Vendor::with('users')->where('id', $id)->first();
    }

    /**
     * This function for get all Vendors what user have
     */
    public function getVendors()
    {
        return Vendor::with('users')->orderBy('created_at', 'DESC')->paginate(10);
    }

    /**
     * Check user has same email
     * 
     * @param Int id vendor
     */
    public function userHasSameEmail(int $id)
    {
        return Vendor::where('id', $id)->select('email')->exists();
    }

    /**
     * This function for create new Vendor or insert into Vendors table
     * 
     * @param Request data request vendor
     * 
     * @return Boolean true or false
     */
    public function storeVendor($data)
    {
        $data['user_parent_id'] = auth()->user()->id;
        return Vendor::create($data);
    }

    /**
     * This function for update a Vendor
     * 
     * @param Int id vendor
     * 
     * @return Boolean true or false
     */
    public function updateVendor(int $id, $data)
    {
        $user = Vendor::where('id', $id)->first();

        if (! $this->userHasSameEmail($id)) {
            $user = Vendor::where('id', $id)->first();
        }

        return $user->update($data);
    }

    /**
     * Update bran status
     * 
     * @param Int id vendor
     * @param Int active
     * 
     * @return Boolean true or false
     */
    public function updateStatusVendor(int $id, int $active)
    {
        $vendor = Vendor::where('id', $id)->first();
        return $vendor->update(['active' => $active]);
    }

    /**
     * Search users data
     * 
     * @param Array data search request
     * 
     * @return Array search result
     */
    public function searchVendorData(array $data)
    {

        $vendors = Vendor::with('users')
                        ->orderBy('created_at', 'DESC')
                        ->select('id', 'vendor_name', 'phone', 'mobile', 'active', 'created_at');

        if ($data['all']) {
            return $this->getVendors();
        }

        if ($data['active']) {
            $vendors->where('active', 1);
        }

        if ($data['inactive']) {
            $vendors->where('active', 0);
        }

        if (! empty($data['search'])) {
            $vendors->where('vendor_name', 'like', '%'. $data['search'] .'%')
                    ->orWhere('email', 'like', '%'. $data['search'] .'%');
        }

        return $vendors->paginate(10);

    }

}