<?php


namespace App\Inspections;

class InvalidKeywords
{
    public function __construct()
    {
        
    }


    protected $keywords = [
        'yahoo customer support',
    ];

    public function detect($body){
        foreach($this->keywords as $keyword){
            if(stripos($body, $keyword) !== false){
                throw new \Exception('your reply contains spam');
            }
        }
    }
}