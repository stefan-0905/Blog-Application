<?php

namespace App\Exceptions;

use Exception;

class DefaultCategoryException extends Exception
{
    protected $message = "You cannot delete this category, Bro. It was set as default and made untouchable.";
    protected $route = "categories.index";

    public function getRoute() {
        return $this->route;
    }
}
