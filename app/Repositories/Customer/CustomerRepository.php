<?php

namespace App\Repositories\Customer;

use App\Customer;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;

class CustomerRepository implements CustomerRepositoryInterface
{

    /**
     * Implement get customer by id
     * 
     * @param Int id customer
     */
    public function getCustomer(int $id)
    {
        return Customer::where('id', $id)->first();
    }

    /**
     * Implement get all customers
     */
    public function getCustomers()
    {

        $customers = Customer::where('user_parent_id', auth()->user()->id)
                    ->select('id', 'firstname', 'lastname', 'email', 'number_id', 'phone', 'active', 'created_at');

        return $customers->orderBy('created_at', 'DESC')
                    ->paginate(10);
    }

    /**
     * Check Customer has same email
     * 
     * @param String email customer
     */
    public function customerHasSameEmail(string $email)
    {
        return Customer::where('email', $email)->select('email')->count('email');
    }

    /**
     * find Customer/or customers custom where
     * 
     * @param String column
     * @param String where clause
     * @param Boolean paginate or not
     * @param Int number of pagination
     */
    public function findCustomer(string $column, string $where, bool $paginate = null, int $paginate_number = null) {
        $customer = Customer::where($column, $where);

        if ($paginate) {
            return $customer->paginate($paginate_number);
        } else {
            return $customer->first();
        }

    }

    /**
     * Store customer to table customers
     * 
     * @param Array data customer
     */
    public function storeCustomer($data)
    {
        $data['user_parent_id'] = auth()->user()->id;
        return Customer::create($data);
    }

    /**
     * Update Customer profile
     * 
     * @param Int id customer
     * @param Array data of customer
     */
    public function updateCustomer(int $id, array $data)
    {

        $customer = Customer::where('id', $id)->first();

        // dd($this->customerHasSameEmail($data['email']));

        if ($this->customerHasSameEmail($data['email']) > 1) {
            $customer = Customer::where('id', $id)->first();
            return ['message', 'email already exist by another user, please insert another email'];
        }

        return $customer->update($data);
    }
    
    /**
     * Update customer profile
     * 
     * @param Int id customer
     * @param Int 1 is active and 0 is inactive status
     */
    public function updateStatusCustomer(int $id, int $active)
    {
        $customer = Customer::where('id', $id)->first();
        return $customer->update(['active' => $active]);
    }

    /**
     * Search users data
     * 
     * @param Array data of search content
     */
    public function searchCustomerData(array $data)
    {

        $customers = Customer::where('user_parent_id', auth()->user()->id)
                    ->orderBy('created_at', 'DESC')
                    ->select('id', 'firstname', 'number_id', 'email', 'phone', 'active', 'created_at');

        if ($data['all']) {
            return $this->getCustomers();
        }

        if ($data['active']) {
            $customers->where('active', 1);
        }

        if ($data['inactive']) {
            $customers->where('active', 0);
        }

        if (! empty($data['search'])) {
            $customers->where('firstname', 'like', '%'. $data['search'] .'%')
                    ->orWhere('lastname', 'like', '%'. $data['search'] .'%');
        }

        return $customers->paginate(10);

    }

} 