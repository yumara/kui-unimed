<?php

namespace App\Repositories;

use App\Helper\QueryBuilder;
use App\Models\UserData;

class UserDataRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(new UserData());
    }

    public function create(string $userId)
    {
        return QueryBuilder::builder($this->model)
            ->build()
            ->create([
                'user_id' => $userId,
            ]);
    }

    public function update(string $userId, array $data) {
        return QueryBuilder::builder($this->model)
            ->where([
                'user_id' => $userId,
            ])
            ->build()
            ->update($data);
    }
}
