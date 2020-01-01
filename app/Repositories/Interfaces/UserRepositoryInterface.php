<?php

namespace App\Repositories\Interfaces;

use App\User;

interface UserRepositoryInterface
{

  /**
   * Get user by id
   */
  public function getUser(int $id);

  /**
   * Get all users
   */
  public function getUsers();

  /**
   * Check user has same email
   */
  public function userHasSameEmail(int $id);

  /**
   * Get user function with where
   */
  public function findUser(string $column, string $where, bool $paginate = null, int $paginate_number = null);

  /**
   * Get user information
   */
  public function getUserInformation(int $id);

  /**
   * inserting user
   */
  public function storeUser($data);

  /**
   * Update user
   */
  public function updateUser(int $id, array $data);

  /**
   * Update user active
   */
  public function updateUserByStatus(int $id, int $active);

  /**
   * Searching user data
   */
  public function searchUserData(array $data);

}