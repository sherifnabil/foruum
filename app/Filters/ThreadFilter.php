<?php

namespace App\Filters;

use App\User;
use App\Filters\Filters;

class ThreadFilter extends Filters
{
    protected $filters = ['by'];

    /**
     * Filter Query by username
     *
     * @param string $username
     * @return mixed
     */
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }
}