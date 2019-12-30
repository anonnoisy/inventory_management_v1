<?php

namespace App\Repositories;

use App\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\UserRole;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserRepository implements UserRepositoryInterface
{

  /**
   * Implement get user by id
   */
  public function getUser(int $id)
  {
    return User::where('id', $id)->first();
  }

  /**
   * Implement get all users
   */
  public function getUsers()
  {
    return User::orderBy('created_at', 'DESC')->paginate(10);
  }

  /**
   * Check user has same email
   */
  public function userHasSameEmail(int $id)
  {
    return User::where('id', $id)->select('email')->exists();
  }

  /**
   * find user/or users custom where
   */
  public function findUser(string $column, string $where, bool $paginate = null, int $paginate_number = null) {
    $user = User::where($column, $where);

    if ($paginate) {
      return $user->paginate($paginate_number)->get();
    } else {
      return $user->first();
    }

  }

  /**
   * Get user profile information
   */
  public function getUserInformation(int $id)
  {
    return User::where('id', $id)->first();
  }

  /**
   * Store user to table users
   */
  public function storeUser($data)
  {
    return User::create($data);
  }

  /**
   * Update user profile
   */
  public function updateUser(int $id, array $data)
  {

    $user = User::where('id', $id)->first();

    if (! $this->userHasSameEmail($id, $data['email'])) {
      User::where('id', $id)->first();
    }

    return $user->update($data);
  }

} 