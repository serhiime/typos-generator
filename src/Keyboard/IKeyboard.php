<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license MIT
 * @copyright Serhii Nekhaienko (c) 2019
 * @version 1.0
 */

namespace SerhiiMe\Typos\Keyboard;

use SerhiiMe\Typos\Exception\KeyNotFoundException;

interface IKeyboard
{
    public function getKeyList(): array;

    /**
     * @param string $key
     * @return array
     * @throws KeyNotFoundException
     */
    public function getKey(string $key): array;
}