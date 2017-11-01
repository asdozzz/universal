<?php

namespace Asdozzz\Universal\Controller;

use App\Universal;
use TableConfig;
use App\User;
use Theme,Request,Exception,Config;
use \Asdozzz\Traits\Crud\Controller as CrudController;

class UniversalController extends \App\Http\Controllers\Controller
{
    use CrudController;

    public $businessName = null;
    public $table = null;

    public function __construct()
    {
        //parent::__construct();
        $this->init();
    }
    
    public function init()
    {
        $className = $classNameOrigin = (new \ReflectionClass($this))->getShortName();
        $className = str_replace('Admin', '', $className);
        $className = str_replace('Controller', '', $className);

        if (empty($this->className))
        {
            $this->className = $className;
        }

        if (empty($this->moduleName))
        {
            $this->moduleName = strtolower($className);
        }

        if (empty($this->businessName))
        {
            dd($classNameOrigin.' set businessName property');
        }

        if (empty($this->table))
        {
            $this->table = strtolower($className);
        }

        if (empty($this->views))
        {
            $this->views = [
                'index' => 'modules.'.$this->moduleName.'.index'
            ];
        }

        $this->business = new $this->businessName;
    }
}