<?php

namespace App\Entity;


class Notification
{
    // the configured property must be declared
    private $state;

// getter/setter methods must exist for property access by the marking store
    public function getState()
    {
        return $this->state;
    }

    public function setState($state, $context = [])
    {
        $this->state = $state;
    }
}
