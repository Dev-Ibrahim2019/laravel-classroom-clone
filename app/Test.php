<?php

namespace App;

class Test
{
    protected string $prefix;
    public function __construct(string $prefix) {
        $this->prefix = $prefix;
    }

    public function print()
    {
        echo $this->prefix . ' Test';
    }
}
