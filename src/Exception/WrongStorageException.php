<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license MIT
 * @copyright Serhii Nekhaienko (c) 2019
 * @version 1.0
 */

namespace SerhiiMe\Typos\Exception;

use SerhiiMe\Typos\Storage\ITyposStorage;

class WrongStorageException extends \Exception implements \Throwable
{
    public function __construct(string $classname)
    {
        parent::__construct(sprintf('Storage "%s" not implements "%s" interface', $classname,ITyposStorage::class), 1, null);
    }

}