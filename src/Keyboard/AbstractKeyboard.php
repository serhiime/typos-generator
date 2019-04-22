<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license MIT
 * @copyright Serhii Nekhaienko (c) 2019
 * @version 1.0
 */

namespace SerhiiMe\Typos\Keyboard;

use SerhiiMe\Typos\Exception\KeyNotFoundException;

/**
 * Class AbstractKeyboard
 * @package SerhiiMe\Typos\Keyboard
 */
abstract class AbstractKeyboard
{
    /**
     * Array of possible wrong keys.
     * @var array
     */
    protected $keys = [

    ];

    public function getKeyList(): array
    {
        return array_keys($this->keys);
    }

    /**
     * @param string $key
     * @return array
     * @throws KeyNotFoundException
     */
    public function getKey(string $key): array
    {
        if(!array_key_exists($key, $this->keys)) {
            throw new KeyNotFoundException($key);
        }
        return $this->keys[$key];
    }
}