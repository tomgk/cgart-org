<?php

/**
 * Description of Core
 *
 * @author Thomas
 */
class Scope
{
    /**
     * @var Scope übergeordneter Scope
     */
    private $parent;
    private $services;

    public function __construct($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return ModelManager der ModelManager
     */
    public static function getModelManager()
    {
        return self::$currentScope->get(ModelManager::SERVICE_NAME);
    }

    /**
     * @return PathGenerator der Pfad-Generator
     */
    public static function getPathGenerator()
    {
        import('PathGenerator');
        return self::$currentScope->get(PathGenerator::SERVICE_NAME);
    }

    public function get($name)
    {
        for($s = $this; $s != null; $s = $s->parent)
            if(isset($s->services[$name]))
                return $s->services[$name];

        throw new UnexpectedValueException();
    }

    public function put($name, $service)
    {
        $this->services[$name] = $service;
    }

    public function useParent($name)
    {
        unset($this->services[$name]);
    }

    private static $rightManager;

    /**
     * @return RightManager der Rechte-Manager
     */
    public static function getRightManager()
    {
        if(self::$rightManager == null)
            throw new RuntimeException('RM not set');
        
        return self::$rightManager;
    }

    public static function setRightManager($rightManager)
    {
        if(self::$rightManager != null)
            throw new InvalidArgumentException('RM already set');

        self::$rightManager = $rightManager;
    }
    
    /**
     * @var Scope die aktuelle Umgebung
     */
    private static $currentScope;
    
    public static function getService($name)
    {
        return self::$currentScope->get($name);
    }
    
    private static $prevScopes;
    
    public static function enter($scope)
    {
        self::$prevScopes[] = self::$currentScope;
        self::$currentScope = $scope;
    }

    public static function leave($scope)
    {
        if($scope != self::$currentScope)
            throw new UnexpectedValueException("Wrong scope");
        
        self::$currentScope = array_pop(self::$prevScopes);
    }
}
?>