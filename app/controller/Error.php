<?php

namespace app\controller;

class Error{
    public function __call($name, $arguments)
    {
            return 'error request!';
    }
}

