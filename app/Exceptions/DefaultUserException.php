<?php

namespace App\Exceptions;

use Exception;

class DefaultUserException extends Exception
{
    protected $message = 'You are trying to delete yourself or admin user. Access denied. Play Nice.';
    protected $route = 'users.index';

    public function getRoute() { return $this->route; }
}
