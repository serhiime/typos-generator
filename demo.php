<?php

include __DIR__.'/vendor/autoload.php';

use SerhiiMe\Typos\TyposGenerator;
use SerhiiMe\Typos\Storage\ArrayTyposStorage;
use SerhiiMe\Typos\Keyboard\EnglishKeyboard;

$options = [
    'wrongKeys' => true,
    'missedChars' => true,
    'transposedChars' => false,
    'doubleChars' => false,
    'storage' => ArrayTyposStorage::class,
    'keyboard' => EnglishKeyboard::class
];

$generator = new TyposGenerator($options);

/** @var $oneResult \SerhiiMe\Typos\Storage\ArrayTyposStorage */
$oneResult = $generator->generate('house')[0];

/** @var $listResult array
List of \SerhiiMe\Typos\Storage\ArrayTyposStorage objects */
$listResult = $generator->generate(['house','abandoned']);
