<?php

namespace Asdozzz\Universal\Datasource;

use Illuminate\Database\Eloquent\Model;
use DB;
use \Asdozzz\Traits\Crud\Datasource as CrudDatasource;

/**
 * Class Universal
 *
 * @package Asdozzz\Universal\Datasource
 */
class Universal
{
	use CrudDatasource;
    /**
     * @var string
     */
    public $primary_key   = '';
    /**
     * @var string
     */
    public $table         = '';
    /**
     * @var bool
     */
    public $softDeletes   = false;
    /**
     * @var string
     */
    public $deleted_field = 'deleted_at';
    /**
     * @var \Asdozzz\Essence\Interfaces\iEssence
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

        $this->table = $this->essence->table;
        $this->primary_key = $this->essence->primary_key;
	}
}