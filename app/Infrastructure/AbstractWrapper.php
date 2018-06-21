<?php
namespace Infrastructure;

use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
abstract class AbstractWrapper implements ArrayAccess, Arrayable, Jsonable, JsonSerializable
{
    /**
     * @var array|mixed[]
     */
    protected $attributes;

    /**
     * @param array|mixed[] $attributes
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function toArray()
    {
        return $this->attributes;
    }

    /**
     * @param mixed $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        return array_get($this->attributes, $key);
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return self
     */
    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return !is_null(array_get($this->attributes, $offset));
    }

    /**
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return array_get($this->attributes, $offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->attributes[$offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->attributes[$offset]);
    }

    /**
     * @param mixed $key
     *
     * @return bool
     */
    public function __isset($key)
    {
        return $this->offsetExists($key);
    }

    /**
     * @param mixed $key
     */
    public function __unset($key)
    {
        $this->offsetUnset($key);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }
}
