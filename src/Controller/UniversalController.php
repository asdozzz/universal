<?php

namespace Asdozzz\Universal\Controller;

use App\User;
use Request,Exception,Config;
use \Asdozzz\Traits\Crud\Controller as CrudController;

/**
 * Class UniversalController
 *
 * @package Asdozzz\Universal\Controller
 */
class UniversalController extends \App\Http\Controllers\Controller
{
    use CrudController;
    /**
     * @var null
     */
    public    $businessName = null;
    /**
     * @var null
     */
    public    $table       = null;
    /**
     * @var null
     */
    public    $essenceName = null;
    /**
     * @var
     */
    protected $essence;
    /**
     * @var
     */
    protected $business;

    /**
     * UniversalController constructor.
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
        $className = str_replace('Admin', '', $className);
        $className = str_replace('Controller', '', $className);

        if (empty($this->essenceName))
        {
            $this->essenceName = $className;
        }

        $this->essence = \Asdozzz\Essence\Essence::factory($this->essenceName);

        if (empty($this->views))
        {
            $this->views = [
                'index' => 'modules.'.$this->essence->moduleName.'.'.$this->essenceName.'.index'
            ];
        }

        $this->business = new $this->essence->businessName;
    }
}