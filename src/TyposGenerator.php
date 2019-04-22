<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license MIT
 * @copyright Serhii Nekhaienko (c) 2019
 * @copyright Michel Le Quer (c) 2016
 * @version 1.0
 */

namespace SerhiiMe\Typos;

use SerhiiMe\Typos\Exception\KeyboardNotFoundException;
use SerhiiMe\Typos\Exception\KeyNotFoundException;
use SerhiiMe\Typos\Exception\StorageNotFoundException;
use SerhiiMe\Typos\Exception\WrongKeyboardException;
use SerhiiMe\Typos\Exception\WrongStorageException;
use SerhiiMe\Typos\Keyboard\EnglishKeyboard;
use SerhiiMe\Typos\Keyboard\IKeyboard;
use SerhiiMe\Typos\Storage\ITyposStorage;
use SerhiiMe\Typos\Storage\ArrayTyposStorage;

/**
 * Based on https://packagist.org/packages/mlequer/typos-generator
 * Class TyposGenerator
 * @package SerhiiMe\Typos
 */
class TyposGenerator
{
    /**
     * @var string Classname of Storage class
     */
    private $storage;

    private $options = [
        'wrongKeys' => false,
        'missedChars' => false,
        'transposedChars' => false,
        'doubleChars' => false,
        'storage' => ArrayTyposStorage::class,
        'keyboard' => EnglishKeyboard::class
    ];

    /**
     * @var IKeyboard
     */
    protected $keyboard;

    /**
     * Constructor.
     *
     * Options example (options set to false can be ommited):<br/>
     * <code>
     * $options = [<br/>
     *     'wrongKeys' => true,<br/>
     *     'missedChars' => true,<br/>
     *     'transposedChars' => false,<br/>
     *     'doubleChars' => false<br/>
     *     'storage' => ArrayTyposStorage::class<br/>
     *     'keyboard' => EnglishKeyboard::class
     * ];
     *
     * @param array $options the options to use for the typo generation
     * @throws KeyboardNotFoundException
     * @throws StorageNotFoundException
     * @throws WrongStorageException
     * @throws WrongKeyboardException
     */
    public function __construct(array $options)
    {
        $this->options = array_merge($this->options, $options);
        if (!class_exists($this->options['keyboard'])) {
            throw new KeyboardNotFoundException($this->options['keyboard']);
        }
        if (!class_exists($this->options['storage'])) {
            throw new StorageNotFoundException($this->options['keyboard']);
        }
        if (!in_array(IKeyboard::class, class_implements($this->options['keyboard']))) {
            throw new WrongKeyboardException($this->options['keyboard']);
        }
        if (!in_array(ITyposStorage::class, class_implements($this->options['storage']))) {
            throw new WrongStorageException($this->options['storage']);
        }

        $this->setStorage($this->options['storage']);
        $this->keyboard = new $this->options['keyboard']();
    }

    /**
     * @param string $storage
     */
    public function setStorage(string $storage)
    {
        if (in_array(ITyposStorage::class, class_implements($storage, true))) {
            $this->storage = $storage;
        }
    }

    /**
     * @param string $word
     * @param ITyposStorage $storage
     * @throws KeyNotFoundException
     */
    protected function wrongKeyTypos(string $word, ITyposStorage &$storage)
    {
        $typos = [];
        $length = mb_strlen($word);

        for ($i = 0; $i < $length; ++$i) {
            $key = $word[$i];
            $keys = $this->keyboard->getKey($key);
            $tempWord = $word;
            foreach ($keys as $char) {
                $typos[] = substr_replace($tempWord, $char, $i, 1);
            }
        }
        $storage->addList($typos);
    }

    /**
     * @param string $word
     * @param ITyposStorage $storage
     */
    private function missedCharsTypos(string $word, ITyposStorage &$storage)
    {
        $typos = [];
        $length = mb_strlen($word);

        for ($i = 0; $i < $length; ++$i) {
            $tempWord = '';
            if ($i == 0) {
                $tempWord = substr($word, $i + 1);
            } elseif (($i + 1) == $length) {
                $tempWord = substr($word, 0, $i);
            } else {
                $tempWord = substr($word, 0, $i);
                $tempWord .= substr($word, $i + 1);
            }
            $typos[] = $tempWord;
        }

        $storage->addList($typos);
    }

    /**
     * @param string $word
     * @param ITyposStorage $storage
     */
    private function transposedCharTypos(string $word, ITyposStorage &$storage)
    {
        $typos = [];
        $length = mb_strlen($word);

        for ($i = 0; $i < $length; ++$i) {
            if (($i + 1) != $length) {
                $tempWord = $word;
                $tempChar = $tempWord[$i];

                $tempWord = substr_replace($tempWord, $tempWord[$i + 1], $i, 1);
                $tempWord = substr_replace($tempWord, $tempChar, $i + 1, 1);
                $typos[] = $tempWord;
            }
        }

        $storage->addList($typos);
    }

    /**
     * @param string $word
     * @param ITyposStorage $storage
     */
    private function doubleCharTypos(string $word, ITyposStorage &$storage)
    {
        $typos = [];
        $length = mb_strlen($word);

        for ($i = 0; $i < $length; ++$i) {
            $tempWord = substr($word, 0, $i + 1);
            $key = $word[$i];
            $tempWord .= $key;
            if ($i != ($length - 1)) {
                $tempWord .= substr($word, $i + 1);
            }
            $typos[] = $tempWord;
        }
        $storage->addList($typos);
    }

    /**
     * @param $word string | array List of word or one word
     * @return array
     * @throws KeyNotFoundException
     */
    public function generate($word): array
    {
        if (is_string($word)) {
            return [$this->getResult($word)];
        }
        if (is_array($word)) {
            $result = [];
            foreach ($word as $w) {
                $result[] = $this->getResult($w);
            }
            return $result;
        }
        return [];
    }

    /**
     * @param string $word
     * @return ITyposStorage
     * @throws KeyNotFoundException
     */
    protected function getResult(string $word): ITyposStorage
    {
        $storage = new $this->storage($word);
        if ($this->options['wrongKeys']) {
            $this->wrongKeyTypos($word, $storage);
        }
        if ($this->options['missedChars']) {
            $this->missedCharsTypos($word, $storage);
        }
        if ($this->options['transposedChars']) {
            $this->transposedCharTypos($word, $storage);
        }
        if ($this->options['doubleChars']) {
            $this->doubleCharTypos($word, $storage);
        }

        return $storage;
    }
}