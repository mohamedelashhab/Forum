<?php

namespace App\Inspections;

class Spam
{
    public function __construct()
    {
        
    }


    protected $inspections = [
        InvalidKeywords::class,
        KeyHeldDown::class
    ];

    public function detect($body)
    {
        foreach($this->inspections as $inspection)
        {
            app($inspection)->detect($body);
        }

        return false;
    }
}