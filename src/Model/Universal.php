<?php

namespace Asdozzz\Universal\Model;

use \Asdozzz\Traits\Crud\Model as CrudModel;

class Universal
{
    use CrudModel;

    protected $softDeletes = false;
    protected $deleted_field = 'deleted_at';
    protected $defaultSchema = 'default';

    public function __construct()
    {
        $className = $classNameOrigin = (new \ReflectionClass($this))->getShortName();

        if (empty($this->table))
        {
            $this->table = strtolower($className);
        }

        if (empty($this->table))
        {
            $this->table = strtolower($className);
        }

        $this->init();
    }

    function init()
    {
        $path = explode('\\', __CLASS__);
        $className =  array_pop($path);
        
        if (empty($this->className))
        {
            $this->className = $className;
        }

        if (empty($this->moduleName))
        {
            $this->moduleName = $className;
        }

        if (empty($this->table))
        {
            $this->table = strtolower($className);
        }

        if (empty($this->essenceName))
        {
            dd($className.' set essenceName property');
        }

        if (empty($this->datasourceName))
        {
            dd($className.' set datasourceName property');
        }

        $this->essence = \Asdozzz\Essence\Essence::factory($this->essenceName);
        $this->datasource = new $this->datasourceName;

        $haystack = ['columns','datatables','permissions','forms','primary_key'];

        foreach ($haystack as $property) 
        {
            $this->{$property} = $this->essence->{$property};
        }

        $this->datasource->softDeletes = $this->essence->softDeletes;
        $this->datasource->deleted_field = $this->essence->deleted_field;
    }

    
}