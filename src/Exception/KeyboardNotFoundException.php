<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license MIT
 * @copyright Serhii Nekhaienko (c) 2019
 * @version 1.0
 */

namespace SerhiiMe\Typos\Exception;


class KeyboardNotFoundException extends \Exception implements \Throwable
{
    public function __construct(string $classname)
    {
        parent::__construct(sprintf('Keyboard "%s" not Found', $classname), 1, null);
    }

}