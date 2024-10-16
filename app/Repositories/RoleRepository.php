<?php

namespace App\Repositories;

use App\Models\Role;
use App\Traits\Repositories\CrudRepository;

class RoleRepository extends Repository
{
    use CrudRepository;

    public function __construct()
    {
        parent::__construct(new Role());
    }
}
