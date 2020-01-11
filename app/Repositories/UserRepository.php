<?php

namespace App\Repositories;

use App\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\UserRole;
use Illuminate\Support\Facades\Hash;
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
  public function getUsers(int $user_roles = null)
  {

    $users = User::where('user_parent_id', auth()->user()->id)
                  ->select('id', 'firstname', 'lastname', 'email', 'active', 'created_at');

    if (! empty($user_roles)) {
      $users->where('user_roles', $user_roles);
    }

    return $users->orderBy('created_at', 'DESC')
                ->paginate(10);
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
      return $user->paginate($paginate_number);
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

    if (! empty($data['password'])) {
      $data['password'] = Hash::make($data['password']);
    }

    return User::create($data);
  }

  /**
   * Update user profile
   */
  public function updateUser(int $id, array $data)
  {

    $user = User::where('id', $id)->first();

    if (! $this->userHasSameEmail($id)) {
      $user = User::where('id', $id)->first();
    }

    return $user->update($data);
  }
  
  /**
   * Update user profile
   */
  public function updateUserByStatus(int $id, int $active)
  {
    $user = User::where('id', $id)->first();
    return $user->update(['active' => $active]);
  }

  /**
   * Search users data
   */
  public function searchUserData(array $data, int $user_roles)
  {

    $users = User::where('user_parent_id', auth()->user()->id)
                  ->where('user_roles', $user_roles)
                  ->orderBy('created_at', 'DESC')
                  ->select('id', 'firstname', 'lastname', 'email', 'active', 'created_at');

    if ($data['all']) {
      return $this->getUsers($user_roles);
    }

    if ($data['active']) {
      $users->where('active', 1);
    }

    if ($data['inactive']) {
      $users->where('active', 0);
    }

    if (! empty($data['search'])) {
      $users->where('firstname', 'like', '%'. $data['search'] .'%')
            ->orWhere('lastname', 'like', '%'. $data['search'] .'%');
    }

    return $users->paginate(10);

  }

} 