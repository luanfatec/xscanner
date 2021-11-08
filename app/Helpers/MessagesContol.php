<?php

namespace App\Helpers;

class MessagesContol {
    public function __get($attr)
    {
        return $this->$attr;
    }

}
