# Animal Sounds

A zero-dependency animal-sound dataset with a small lookup API. The original JSON file remains available at `resources/animal-sounds.json` for applications that prefer to load the data directly.

## Installation

```bash
composer require jord-jd/animal-sounds
```

## Usage

```php
use JordJD\AnimalSounds\AnimalSounds;

AnimalSounds::soundsFor('cat');
// ['mew', 'meow', 'purr', 'hiss']

AnimalSounds::animalsForSound('roar');
// ['bear', 'tiger', 'lion', 'jaguar', 'leopard']

AnimalSounds::randomSoundFor('dog');
// e.g. 'woof'

$all = AnimalSounds::all();
```

Animal and sound lookups are case-insensitive and ignore surrounding whitespace. Unknown animals return an empty array, and `randomSoundFor()` returns `null` when no sounds are known.
