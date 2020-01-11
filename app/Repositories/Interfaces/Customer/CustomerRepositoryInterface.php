<?php

namespace App\Repositories\Interfaces\Customer;

interface CustomerRepositoryInterface
{

    /**
     * Get user by id
     */
    public function getCustomer(int $id);

    /**
     * Get all Customers
     */
    public function getCustomers();

    /**
     * Check Customer has same email
     */
    public function CustomerHasSameEmail(string $email);

    /**
     * Get Customer function with where
     */
    public function findCustomer(string $column, string $where, bool $paginate = null, int $paginate_number = null);

    /**
     * inserting Customer
     */
    public function storeCustomer($data);

    /**
     * Update Customer
     */
    public function updateCustomer(int $id, array $data);

    /**
     * Update Customer active
     */
    public function updateStatusCustomer(int $id, int $active);

    /**
     * Searching Customer data
     */
    public function searchCustomerData(array $data);

}