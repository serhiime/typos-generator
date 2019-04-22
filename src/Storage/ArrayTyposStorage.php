<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license MIT
 * @copyright Serhii Nekhaienko (c) 2019
 * @version 1.0
 */

namespace SerhiiMe\Typos\Storage;

/**
 * Class ArrayTyposStorage
 * @package SerhiiMe\Typos\Storage
 */
final class ArrayTyposStorage implements ITyposStorage
{
    /**
     * @var array
     */
    private $list;

    /**
     * @var string
     */
    private $originalWord;

    /**
     * @return string
     */
    public function getOriginalWord(): string
    {
        return $this->originalWord;
    }

    public function __construct(string $originalWord)
    {
        $this->originalWord = $originalWord;
        $this->list = [];
    }

    /**
     * Add new typos to list
     * @param string $typos
     */
    public function addTypos(string $typos)
    {
        $this->list[] = $typos;
        $this->list = array_unique($this->list);
    }

    /**
     * Add list of typos to storage
     * @param array $typos
     */
    public function addList(array $typos) {
        $this->list = array_merge($this->list, $typos);
        $this->list = array_unique($this->list);
    }

    /**
     * Return list of typos in collection
     * @return array
     */
    public function getList(): array
    {
        return $this->list;
    }

    /**
     * Return count of typos in collection
     * @return int
     */
    public function getCount(): int
    {
        return count($this->list);
    }

    /**
     * Remove storage from memory
     */
    public function remove()
    {
        /** Not needed in this storage */
    }
}