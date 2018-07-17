<?php

namespace Asdozzz\Universal\Model;

use \Asdozzz\Traits\Crud\Model as CrudModel;

/**
 * Class Universal
 *
 * @package Asdozzz\Universal\Model
 */
class Universal
{
    use CrudModel;
    /**
     * @var bool
     */
    protected $softDeletes   = false;
    /**
     * @var string
     */
    protected $deleted_field = 'deleted_at';
    /**
     * @var string
     */
    protected $defaultSchema = 'default';
    /**
     * @var
     */
    protected $datasource;
    /**
     * @var
     */
    protected $essence;

    /**
     * Universal constructor.
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     *
     */
    function init()
    {
        $className = $classNameOrigin = (new \ReflectionClass($this))->getShortName();

        if (empty($this->essenceName))
        {
            $this->essenceName = $className;
        }

        $this->essence = \Asdozzz\Essence\Essence::factory($this->essenceName);

        $this->datasource = new $this->essence->datasourceName;

        $haystack = ['columns','datatables','permissions','forms','primary_key'];

        foreach ($haystack as $property) 
        {
            $this->{$property} = $this->essence->{$property};
        }

        $this->datasource->softDeletes = $this->essence->softDeletes;
        $this->datasource->deleted_field = $this->essence->deleted_field;
    }

    
}