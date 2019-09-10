<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    protected $request, $builder;
    protected $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function apply($builder)
    {
        $this->builder = $builder;

        collect($this->getFilters())->filter(function($filter){
            return method_exists($this, $filter);
        })
        ->each(function($filter, $value){
            $this->$filter($value);
        });

        // foreach($this->getFilters() as $filter => $value)
        // {
        //     if(method_exists($this, $filter))
        //     {
        //         $this->$filter($value);
        //     }
        // }

        if($this->request->has('by'))
        {
            $this->by($this->request->by);
        }
        return $this->builder;
    }

    public function hasFilter($filter)
    {
        return method_exists($this, $filter) && $this->request->has('$filter');
    }

    public function getFilters()
    {
        return collect($this->request->only($this->filters))->flip();
    }
}