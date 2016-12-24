<?php

namespace CoreBundle\Enum;

abstract class AbstractEnum
{
    /**
     * @var mixed
     */
    const __default = null;
    /**
     * @var \ReflectionClass[]
     */
    protected static $_reflects;
    /**
     * @var mixed
     */
    protected $_value;

    /**
     * AbstractEnum constructor.
     *
     * @param mixed $value
     *
     * @throws \UnexpectedValueException
     */
    public function __construct($value = null)
    {
        $this->set($value);
    }

    /**
     * @param $value
     *
     * @return AbstractEnum
     * @throws \UnexpectedValueException
     */
    public function set($value) : self
    {
        if (!$value) {
            $value = static::__default;
        } elseif (!static::has($value)) {
            throw new \UnexpectedValueException();
        }

        $this->_value = $value;

        return $this;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public static function has($value) : bool
    {
        if (!static::$_reflects || !array_key_exists(static::class, static::$_reflects)) {
            static::$_reflects[static::class] = new \ReflectionClass(static::class);
        }

        return in_array($value, static::$_reflects[static::class]->getConstants());
    }

    /**
     * @return array
     * @param $constName boolean
     */
    public static function __toArray($constName = false) : array
    {
        if (!static::$_reflects || !array_key_exists(static::class, static::$_reflects)) {
            static::$_reflects[static::class] = new \ReflectionClass(static::class);
        }

        $array = array();

        $reflect = static::$_reflects[static::class];
        foreach ($reflect->getConstants() as $key => $constant) {
            if ($constant !== null) {
                if($constName){
                    $array[$key] = $key;
                }
                else{
                    $array[$constant] = $constant;
                }

            }
        }
        return $array;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return (string)$this->get();
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->_value;
    }
}