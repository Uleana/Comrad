<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classEnum
 *
 * @author alexandr
 */
final class EnumException extends Exception{}
abstract class Enum
{
    /**
     * @var array ReflectionClass
     */
    protected static $reflectorInstances = array();
    /**
     * Массив конфигурированного объекта-константы enum
     * @var array
     */
    protected static $enumInstances = array();
    /**
     * Массив соответствий значение->ключ используется для проверки - 
     * если ли константа с таким значением
     * @var array
     */
    protected static $foundNameValueLink = array();
    
    protected $constName;
    protected $constValue;
    
    /**
     * Реализует паттерн "Одиночка"
     * Возвращает объект константы, но но как объект его использовать не стоит, 
     * т.к. для него реализован "волшебный метод" __toString()
     * Это должно использоваться только для типизачии его как параметра
     * @paradm Node
     */
    final public static function get($value)
    {
        // Это остается здесь для увеличения производительности (по замерам ~10%)
        $name = self::getName($value);
        if ($name === false)
            throw new EnumException("Неизвестая константа");
        $className = get_called_class();    
        if (!isset(self::$enumInstances[$className][$name]))
        {
            $value = constant($className.'::'.$name);
            self::$enumInstances[$className][$name] = new $className($name, $value);
        }

        return self::$enumInstances[$className][$name];
    }
        
    /**
     * Возвращает массив констант пар ключ-значение всего перечисления
     * @return array 
     */
    final public static function toArray()
    {
        $classConstantsArray = self::getReflectorInstance()->getConstants();
        foreach ($classConstantsArray as $k => $v)
            $classConstantsArray[$k] = (string)$v;
        return $classConstantsArray;
    }
    
    /**
     * Для последующего использования в toArray для получения массива констант ключ->значение 
     * @return ReflectionClass
     */
    final private static function getReflectorInstance()
    {
        $className = get_called_class();
        if (!isset(self::$reflectorInstances[$className]))
        {
            self::$reflectorInstances[$className] = new ReflectionClass($className);
        }
        return self::$reflectorInstances[$className];
    }
    
    /**
     * Получает имя константы по её значению
     * @param string $value
     */
    final public static function getName($value)
    {
        $className = (string)get_called_class();
        
        $value = (string)$value;
        if (!isset(self::$foundNameValueLink[$className][$value]))
        {
            $constantName = array_search($value, self::toArray(), true);
            self::$foundNameValueLink[$className][$value] = $constantName;
        }
        return self::$foundNameValueLink[$className][$value];
    }
    
    /**
     * Используется ли такое имя константы в перечислении
     * @param string $name
     */
    final public static function isExistName($name)
    {
        $constArray = self::toArray();
        return isset($constArray[$name]);
    }
    
    /**
     * Используется ли такое значение константы в перечислении
     * @param string $value
     */
    final public static function isExistValue($value)
    {
        return self::getName($value) === false ? false : true;
    }   

    
    final private function __clone(){}

    final private function __construct($name, $value)
    {
        $this->constName = $name;
        $this->constValue = $value;
    }
    
    final public function __toString()
    {
        return (string)$this->constValue;
    }
}
?>