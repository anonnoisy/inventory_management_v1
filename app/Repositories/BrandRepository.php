<?php

namespace App\Repositories;

use App\Brand;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use App\User;

class BrandRepository implements BrandRepositoryInterface
{

    /**
     * This function for get a brand by id
     */
    public function getBrandById(int $id)
    {
        return Brand::with('users')->where('id', $id)->first();
    }

    /**
     * This function for get a brand by code name
     */
    public function getBrandByCodeName(string $code_name)
    {
        return Brand::with('users')->where('code_name', $code_name)->first();
    }

    /**
     * This function for get all brands what user have
     */
    public function getBrands()
    {
        return Brand::with('users')->orderBy('created_at', 'DESC')->paginate(10);
    }

    /**
     * This function for create generate random string
     */
    public function generateRandomString(int $length = null)
    {
        return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    /**
     * This function for genreate random code name of brand
     */
    public function generateRandomCodeName(string $name)
    {
        $get_first_word = explode(' ', trim($name));
        $get_first_word = strtoupper($get_first_word[0]);
        return "BN_" . $get_first_word . date_format(now(), 'dmy') . "_" . $this->generateRandomString(5);
    }

    /**
     * This function for create new brand or insert into brands table
     */
    public function storeBrand($data)
    {
        if (empty($data['code_name'])) {
            $data['code_name'] = $this->generateRandomCodeName($data['name']);
        }

        // dd($data);
        return Brand::create($data);
    }

    /**
     * This function for update a brand
     */
    public function updateBrand(int $id, $data)
    {
        return Brand::findOrFail($id)
                    ->update([
                        'name' => $data['name'],
                        'code_name' => $data['code_name'],
                        'description' => $data['description']
                    ]);
    }

    /**
   * Update bran status
   */
    public function updateStatusBrand(int $id, int $active)
    {
        $brand = Brand::where('id', $id)->first();
        return $brand->update(['active' => $active]);
    }

    /**
   * Search users data
   */
    public function searchBrandData(array $data)
    {

        $brands = Brand::with('users')
                        ->orderBy('created_at', 'DESC')
                        ->select('id', 'name', 'code_name', 'active', 'created_at');

        if ($data['all']) {
            return $this->getBrands();
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