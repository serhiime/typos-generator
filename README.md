Generator of typos based on https://github.com/lequer/TyposGenerator
[Live demo](http://detector.endorphin-studio.ru/demo/)

## Code Status
[![Latest Stable Version](https://poser.pugx.org/serhiime/typos-generator/v/stable)](https://packagist.org/packages/endorphin-studio/browser-detector)
[![Total Downloads](https://poser.pugx.org/serhiime/typos-generator/downloads)](https://packagist.org/packages/endorphin-studio/browser-detector)
[![License](https://poser.pugx.org/serhiime/typos-generator/license)](https://packagist.org/packages/endorphin-studio/browser-detector)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/serhiime/typos-generator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/serhiime/typos-generator/?branch=master)

## About
	Author: Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
	Current Version: 1.0
	Stable Version: 1.0
	License: MIT

## Requirements
	PHP 7.0+

## Install via Composer
    composer require serhiime/typos-generator
## Basic Usage

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