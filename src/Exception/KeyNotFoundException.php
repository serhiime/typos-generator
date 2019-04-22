<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license MIT
 * @copyright Serhii Nekhaienko (c) 2019
 * @version 1.0
 */

namespace SerhiiMe\Typos\Exception;

class KeyNotFoundException extends \Exception implements \Throwable
{
    public function __construct(string $key)
    {
        parent::__construct(sprintf('Key "%s" not Found', $key), 1, null);
    }
}