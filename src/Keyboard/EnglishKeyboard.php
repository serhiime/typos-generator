<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license MIT
 * @copyright Serhii Nekhaienko (c) 2019
 * @copyright Michel Le Quer (c) 2016
 * @version 1.0
 */

namespace SerhiiMe\Typos\Keyboard;

class EnglishKeyboard extends AbstractKeyboard implements IKeyboard
{
    /**
     * Array of possible wrong keys.
     *
     * @var array
     */
    protected $keys = [
        '1' => ['2', 'q'],
        '2' => ['1', 'q', 'w', '3'],
        '3' => ['2', 'w', 'e', '4'],
        '4' => ['3', 'e', 'r', '5'],
        '5' => ['4', 'r', 't', '6'],
        '6' => ['5', 't', 'y', '7'],
        '7' => ['6', 'y', 'u', '8'],
        '8' => ['7', 'u', 'i', '9'],
        '9' => ['8', 'i', 'o', '0'],
        '0' => ['9', 'o', 'p', '-'],
        '-' => ['0', 'p'],
        'q' => ['1', '2', 'w', 'a'],
        'w' => ['q', 'a', 's', 'e', '3', '2'],
        'e' => ['w', 's', 'd', 'r', '4', '3'],
        'r' => ['e', 'd', 'f', 't', '5', '4'],
        't' => ['r', 'f', 'g', 'y', '6', '5'],
        'y' => ['t', 'g', 'h', 'u', '7', '6'],
        'u' => ['y', 'h', 'j', 'i', '8', '7'],
        'i' => ['u', 'j', 'k', 'o', '9', '8'],
        'o' => ['i', 'k', 'l', 'p', '0', '9'],
        'p' => ['o', 'l', '-', '0'],
        'a' => ['z', 's', 'w', 'q'],
        's' => ['a', 'z', 'x', 'd', 'e', 'w'],
        'd' => ['s', 'x', 'c', 'f', 'r', 'e'],
        'f' => ['d', 'c', 'v', 'g', 't', 'r'],
        'g' => ['f', 'v', 'b', 'h', 'y', 't'],
        'h' => ['g', 'b', 'n', 'j', 'u', 'y'],
        'j' => ['h', 'n', 'm', 'k', 'i', 'u'],
        'k' => ['j', 'm', 'l', 'o', 'i'],
        'l' => ['k', 'p', 'o'],
        'z' => ['x', 's', 'a'],
        'x' => ['z', 'c', 'd', 's'],
        'c' => ['x', 'v', 'f', 'd'],
        'v' => ['c', 'b', 'g', 'f'],
        'b' => ['v', 'n', 'h', 'g'],
        'n' => ['b', 'm', 'j', 'h'],
        'm' => ['n', 'k', 'j'],
    ];
}