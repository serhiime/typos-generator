<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license MIT
 * @copyright Serhii Nekhaienko (c) 2019
 * @version 1.0
 */

namespace SerhiiMe\Typos\Storage;

interface ITyposStorage
{
    public function __construct(string $originalWord);

    /**
     * @return string Get original word
     */
    public function getOriginalWord(): string;

    /**
     * Add one typos to storage
     * @param string $typos
     * @return mixed
     */
    public function addTypos(string $typos);

    /**
     * Add list of typos in storage
     * @param array $typos
     * @return mixed
     */
    public function addList(array $typos);

    /**
     * Get list of all typos in storage
     * @return array
     */
    public function getList(): array;

    /**
     * Get count of typos in storage
     * @return int
     */
    public function getCount(): int;

    /**
     * Remove storage from memory
     * @return mixed
     */
    public function remove();
}