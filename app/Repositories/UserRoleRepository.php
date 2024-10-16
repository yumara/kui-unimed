<?php

namespace App\Repositories;

use App\Helper\QueryBuilder;
use App\Models\UserRole;

class UserRoleRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(new UserRole());
    }

    public function create(string $userId, string $roleId)
    {
        return QueryBuilder::builder($this->model)
            ->build()
            ->create([
                'user_id' => $userId,
                'role_id' => $roleId,
            ]);
    }

    public function delete(string $userId, string $roleId)
    {
        return QueryBuilder::builder($this->model)
            ->where([
                'user_id' => $userId,
                'role_id' => $roleId,
            ])
            ->build()
            ->delete();
    }
}
