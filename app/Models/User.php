<?php

namespace App\Models;

class User
{
    public $firstName;

    public function setFirstName($firstName)
    {
        $this->firstName = trim($firstName);
    }

    public function getFirstName()
    {
        return 'Billy';
    }
}

?>