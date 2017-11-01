<?php

namespace Asdozzz\Universal\Datasource;

use Illuminate\Database\Eloquent\Model;
use DB;
use \Asdozzz\Traits\Crud\Datasource as CrudDatasource;

class Universal
{
	use CrudDatasource;

    public $primary_key = '';
    public $table = '';
    public $softDeletes = false;
    public $deleted_field = 'deleted_at';

	public function __construct()
	{
        $className = $classNameOrigin = (new \ReflectionClass($this))->getShortName();

        if (empty($this->table))
        {
            $this->table = strtolower($className);
        }

        if (empty($this->primary_key))
        {
            $this->primary_key = 'id';
        }

		$this->init();
	}

	public function init()
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

        if (empty($this->primary_key))
        {
            throw new \Exception(__CLASS__.":need set primary_key property");
        }

        if (empty($this->table))
        {
            throw new \Exception(__CLASS__.":need set table property");
        }
	}
}