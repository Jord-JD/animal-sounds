<?php

use JordJD\AnimalSounds\AnimalSounds;

require __DIR__.'/../vendor/autoload.php';

function assertSameValue($expected, $actual, $message)
{
    if ($expected !== $actual) {
        throw new RuntimeException($message);
    }
}

assertSameValue(array('mew', 'meow', 'purr', 'hiss'), AnimalSounds::soundsFor(' CAT '), 'Animal lookup failed.');
assertSameValue(array('bugle', 'bleat'), AnimalSounds::soundsFor('elk'), 'Corrected elk sound missing.');
assertSameValue(array(), AnimalSounds::soundsFor('unknown'), 'Unknown animals should return an empty array.');
assertSameValue(null, AnimalSounds::randomSoundFor('unknown'), 'Unknown animals should not have a random sound.');

$roaringAnimals = AnimalSounds::animalsForSound('ROAR');
foreach (array('bear', 'tiger', 'lion', 'jaguar', 'leopard') as $animal) {
    if (!in_array($animal, $roaringAnimals, true)) {
        throw new RuntimeException('Reverse sound lookup failed for '.$animal.'.');
    }
}

echo "Animal sounds smoke tests passed.\n";
