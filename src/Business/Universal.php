<?php

namespace Asdozzz\Universal\Business;

use Illuminate\Database\Eloquent\Model;
use DB,Datatables,TableConfig;
use \Asdozzz\Traits\Crud\Business as CrudBusiness;

/**
 * Class Universal
 *
 * @package Asdozzz\Universal\Business
 */
class Universal
{
	use CrudBusiness;
    /**
     * @var
     */
    public $model;
    /**
     * @var
     */
    public $essence;

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
    public function init()
	{
		$className = $classNameOrigin = (new \ReflectionClass($this))->getShortName();

        if (empty($this->essenceName))
        {
            $this->essenceName = $className;
        }

        $this->essence = \Asdozzz\Essence\Essence::factory($this->essenceName);

        $this->model = new $this->essence->modelName;
	}
}