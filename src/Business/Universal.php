<?php

namespace Asdozzz\Universal\Business;

use Illuminate\Database\Eloquent\Model;
use DB,Datatables,TableConfig;
use \Asdozzz\Traits\Crud\Business as CrudBusiness;

class Universal
{
	use CrudBusiness;

	public function __construct()
	{
		$this->init();
	}

	public function init()
	{
		$className = $classNameOrigin = (new \ReflectionClass($this))->getShortName();

        if (empty($this->className))
        {
            $this->className = $className;
        }

        if (empty($this->modelName))
        {
        	dd($classNameOrigin.' set modelName property');
        }

        $this->model = new $this->modelName;
	}
}