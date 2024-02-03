<?php

declare(strict_types=1);

namespace PST\Testing;

use PST\Testing\Exceptions\ShouldException;

use Exception;
use Throwable;

/**
 * A collection of assertion methods
 * 
 * @package PST\Testing
 * 
 */
class Should {
    private function __construct() {}

    /******************************* be *******************************/

    /**
     * Asserts that the value is strictly equal to the given value
     * 
     * @param mixed $value 
     * @param mixed[] $values 
     * 
     * @return void 
     * 
     * @throws ShouldException 
     * 
     */
    public static function be($value, ...$values): void {
        foreach ($values as $k => $v)
            if ($value !== $v)
                throw new ShouldException("[$k] " . gettype($value) . " is not " . gettype($v));
    }

    /**
     * Asserts that the value is not strictly equal to the given value
     * 
     * @param mixed $value 
     * @param mixed[] $values 
     * 
     * @return void 
     * 
     * @throws ShouldException 
     * 
     */
    public static function notBe($value, ...$values): void {
        foreach ($values as $k => $v)
            if ($value === $v)
                throw new ShouldException("[$k] " . gettype($value) . " is " . gettype($v));
    }

    /******************************* equal *******************************/

    /**
     * Asserts that the value is equal to the given value
     * 
     * @param mixed $value 
     * @param mixed[] $values 
     * 
     * @return void 
     * 
     * @throws ShouldException 
     * 
     */
    public static function equal($value, ...$values): void {
        foreach ($values as $k => $v)
            if ($value != $v)
                throw new ShouldException("[$k] " . gettype($value) . " is not equal to " . gettype($v));
    }

    /**
     * Asserts that the value is not equal to the given value
     * 
     * @param mixed $value 
     * @param mixed[] $values 
     * 
     * @return void 
     * 
     * @throws ShouldException 
     * 
     */
    public static function notEqual($value, ...$values): void {
        foreach ($values as $k => $v)
            if ($value == $v)
                throw new ShouldException("[$k] " . gettype($value) . " is equal to " . gettype($v));
    }

    /******************************* beTrue *******************************/

    /**
     * Asserts that the value is true
     * 
     * @param bool[] $values 
     * 
     * @return void 
     * 
     * @throws ShouldException 
     * 
     */
    public static function beTrue(bool ...$values): void {
        foreach ($values as $k => $value)
            if ($value !== true)
                throw new ShouldException("[$k] " . gettype($value) . " is not true");
    }

    /**
     * Asserts that the value is not true
     * 
     * @param bool[] $values 
     * 
     * @return void 
     * 
     * @throws ShouldException 
     * 
     */
    public static function notBeTrue(bool ...$values): void {
        foreach ($values as $k => $value)
            if ($value === true)
                throw new ShouldException("[$k] " . gettype($value) . " is true");
    }

    /******************************* beFalse *******************************/

    /**
     * Asserts that the value is false
     * 
     * @param bool[] $values 
     * 
     * @return void 
     * 
     * @throws ShouldException 
     * 
     */
    public static function beFalse(bool ...$values): void {
        foreach ($values as $k => $value)
            if ($value !== false)
                throw new ShouldException("[$k] " . gettype($value) . " is not false");
    }

    /**
     * Asserts that the value is not false
     * 
     * @param bool[] $values 
     * 
     * @return void 
     * 
     * @throws ShouldException 
     * 
     */
    public static function notBeFalse(bool ...$values): void {
        foreach ($values as $k => $value)
            if ($value === false)
                throw new ShouldException("[$k] " . gettype($value) . " is false");
    }

    /******************************* beNull *******************************/

    /**
     * Asserts that the value is null
     * 
     * @param mixed[] $values 
     * 
     * @return void 
     * 
     * @throws ShouldException 
     * 
     */
    public static function beNull(...$values): void {
        foreach ($values as $k => $value)
            if ($value !== null)
                throw new ShouldException("[$k] " . gettype($value) . " is not null");
    }

    /**
     * Asserts that the value is not null
     * 
     * @param mixed[] $values 
     * 
     * @return void 
     * 
     * @throws ShouldException 
     * 
     */
    public static function notBeNull(...$values): void {
        foreach ($values as $k => $value)
            if ($value === null)
                throw new ShouldException("[$k] " . gettype($value) . " is null");
    }

    /******************************* haveMethod *******************************/

    /**
     * Asserts that the object has the given method
     * 
     * @param string|object $object 
     * @param string[] $methods 
     * 
     * @return void 
     * 
     * @throws Exception 
     * @throws ShouldException 
     * 
     */
    public static function haveMethod(/*PHP8 string|object*/ $object, string ...$methods): void {
        if (is_object($object))
            $object = get_class($object);
        else if (!is_string($object))
            throw new Exception("Object must be a string or an object");

        foreach ($methods as $k => $method) {
/* 
            NOTE: not sure why my IDE thinks $method is not a string. I tried renaming it to other variable names with the same problem
            Have to do this unneeded cast to get rid of the warning.  Repeating problem in other methods. seems to have something to do
            with the docblock type hinting 
*/

            if (!method_exists($object, (string) $method))
                throw new ShouldException("[$k] Method '$method' does not exist");
        }
    }

    /**
     * Asserts that the object does not have the given method
     * 
     * @param string|object $object 
     * @param string[] $methods 
     * 
     * @return void 
     * 
     * @throws Exception 
     * @throws ShouldException 
     * 
     */
    public static function notHaveMethod(/*PHP8 string|object*/ $object, string ...$methods): void {
        if (is_object($object))
            $object = get_class($object);
        else if (!is_string($object))
            throw new Exception("Object must be a string or an object");

        foreach ($methods as $k => $method)
            if (method_exists($object, (string) $method))
                throw new ShouldException("[$k] Method '$method' exists");
    }

    /******************************* beA *******************************/

    /**
     * Asserts that the object is an instance of the given class or interface
     * 
     * @param string|object $object 
     * @param string[] $classes 
     * 
     * @return void 
     * 
     * @throws ShouldException 
     * 
     */
    public static function beA(/*PHP8 string|object*/ $object, string ...$classes): void {
        if (is_object($object))
            $object = get_class($object);
        else if (!is_string($object))
            throw new Exception("Object must be a string or an object");

        foreach ($classes as $k => $class)
            if (!is_a($object, (string) $class, true))
                throw new ShouldException("[$k] Object '$object' is not an instance of '$class'");
    }

    /**
     * Asserts that the object is not an instance of the given class or interface
     * 
     * @param string|object $object 
     * @param string[] $classes 
     * 
     * @return void 
     * 
     * @throws ShouldException 
     * 
     */
    public static function notBeA(/*PHP8 string|object*/ $object, string ...$classes): void {
        if (is_object($object))
            $object = get_class($object);
        else if (!is_string($object))
            throw new Exception("Object must be a string or an object");

        foreach ($classes as $k => $class)
            if (is_a($object, (string) $class, true))
                throw new ShouldException("[$k] Object '$object' is an instance of '$class'");
    }

    /******************************* beAClass *******************************/

    /**
     * Asserts that the class exists
     * 
     * @param string[] $classes 
     * 
     * @return void 
     * 
     * @throws ShouldException 
     * 
     */
    public static function beAClass(string ...$classes): void {
        foreach ($classes as $k => $class)
            if (!class_exists((string) $class))
                throw new ShouldException("[$k] Class '$class' does not exist");
    }

    /**
     * Asserts that the class does not exist
     * 
     * @param string[] $classes 
     * 
     * @return void 
     * 
     * @throws ShouldException 
     * 
     */
    public static function notBeAClass(string ...$classes): void {
        foreach ($classes as $k => $class)
            if (class_exists((string) $class))
                throw new ShouldException("[$k] Class '$class' exists");
    }

    /******************************* beAnInterface *******************************/

    /**
     * Asserts that the interface exists
     * 
     * @param string[] $interfaces 
     * 
     * @return void 
     * 
     * @throws ShouldException 
     * 
     */
    public static function beAnInterface(string ...$interfaces): void {
        foreach ($interfaces as $k => $interface)
            if (!interface_exists((string) $interface))
                throw new ShouldException("[$k] Interface '$interface' does not exist");
    }

    /**
     * Asserts that the interface does not exist
     * 
     * @param string[] $interfaces 
     * 
     * @return void 
     * 
     * @throws ShouldException 
     * 
     */
    public static function notBeAnInterface(string ...$interfaces): void {
        foreach ($interfaces as $k => $interface)
            if (interface_exists((string) $interface))
                throw new ShouldException("[$k] Interface '$interface' exists");
    }

    /******************************* beATrait *******************************/

    /**
     * Asserts that the trait exists
     * 
     * @param string[] $traits 
     * 
     * @return void 
     * 
     * @throws ShouldException 
     * 
     */
    public static function beATrait(string ...$traits): void {
        foreach ($traits as $k => $trait)
            if (!trait_exists((string) $trait))
                throw new ShouldException("[$k] Trait '$trait' does not exist");
    }

    /**
     * Asserts that the trait does not exist
     * 
     * @param string[] $traits 
     * 
     * @return void 
     * 
     * @throws ShouldException 
     * 
     */
    public static function notBeATrait(string ...$traits): void {
        foreach ($traits as $k => $trait)
            if (trait_exists((string) $trait))
                throw new ShouldException("[$k] Trait '$trait' exists");
    }

    /******************************* beAnEnum *******************************/

    /**
     * Asserts that the enum exists
     * 
     * @param string[] $enums 
     * 
     * @return void 
     * 
     * @throws Exception 
     * @throws ShouldException 
     * 
     */
    public static function beAnEnum(string ...$enums): void {
        if (PHP_VERSION_ID < 80100)
            throw new Exception("Enums are only supported in PHP 8.1 and later");

        foreach ($enums as $k => $enum)
            if (!enum_exists((string) $enum))
                throw new ShouldException("[$k] Enum '$enum' does not exist");
    }

    /**
     * Asserts that the enum does not exist
     * 
     * @param string[] $enums 
     * 
     * @return void 
     * 
     * @throws Exception 
     * @throws ShouldException 
     * 
     */
    public static function notBeAnEnum(string ...$enums): void {
        if (PHP_VERSION_ID < 80100)
            throw new Exception("Enums are only supported in PHP 8.1 and later");

        foreach ($enums as $k => $enum)
            if (enum_exists((string) $enum))
                throw new ShouldException("[$k] Enum '$enum' exists");
    }

    /******************************* haveTrait *******************************/

    /**
     * Asserts that the object uses the given trait
     * 
     * @param string|object $object 
     * @param string[] $traits 
     * 
     * @return void 
     * 
     * @throws Exception 
     * @throws ShouldException 
     */
    public static function haveTrait(/*PHP8 string|object*/ $object, string ...$traits): void {
        if (is_object($object))
            $object = get_class($object);
        else if (!is_string($object))
            throw new Exception("Object must be a string or an object");

        foreach ($traits as $k => $trait)
            if (!in_array($trait, class_uses($object), true))
                throw new ShouldException("[$k] Object '$object' does not use trait '$trait'");
    }

    /**
     * Asserts that the object does not use the given trait
     * 
     * @param string|object $object 
     * @param string[] $traits 
     * 
     * @return void 
     * 
     * @throws Exception 
     * @throws ShouldException 
     */
    public static function notHaveTrait(/*PHP8 string|object*/ $object, string ...$traits): void {
        if (is_object($object))
            $object = get_Class($object);
        else if (!is_string($object))
            throw new Exception("Object must be a string or an object");

        foreach ($traits as $k => $trait)
            if (in_array($trait, class_uses($object), true))
                throw new ShouldException("[$k] Object '$object' uses trait '$trait'");
    }

    /******************************* throw *******************************/

    /**
     * Asserts that the given exception is thrown
     * 
     * @param string $exception 
     * @param callable[] $callables 
     * 
     * @return void 
     * 
     * @throws ShouldException 
     * 
     */
    public static function throw(string $exception, callable ...$callables): void {
        foreach ($callables as $k => $callable) {
            try {
                $callable();

            } catch (Throwable $e) {
                if (get_class($e) !== $exception)
                    throw new ShouldException("[$k] Exception '$exception' was not thrown");

                continue;
            } 

            throw new ShouldException("[$k] Exception '$exception' was not thrown");
        }
    }

    /**
     * Asserts that the given exception is not thrown
     * 
     * @param string $exception 
     * @param callable[] $callables 
     * 
     * @return void 
     * 
     * @throws ShouldException 
     * 
     */
    public static function notThrow(string $exception, callable ...$callables): void {
        foreach ($callables as $k => $callable) {
            try {
                $callable();

            } catch (Throwable $e) {
                if (get_class($e) === $exception)
                    throw new ShouldException("[$k] Exception '$exception' was thrown");

                continue;
            } 
        }
    }






    
    
}