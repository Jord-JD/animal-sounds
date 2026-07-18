<?php

namespace JordJD\AnimalSounds;

use RuntimeException;

class AnimalSounds
{
    private static $sounds;

    /**
     * Return every animal and its sounds.
     *
     * @return array
     */
    public static function all()
    {
        if (self::$sounds === null) {
            $json = file_get_contents(__DIR__.'/../resources/animal-sounds.json');
            $sounds = json_decode($json, true);

            if (!is_array($sounds)) {
                throw new RuntimeException('Unable to load the bundled animal sounds data.');
            }

            self::$sounds = $sounds;
        }

        return self::$sounds;
    }

    /**
     * Return the known sounds for an animal, or an empty array if unknown.
     *
     * @param string $animal
     *
     * @return array
     */
    public static function soundsFor($animal)
    {
        $animal = strtolower(trim((string) $animal));
        $sounds = self::all();

        return array_key_exists($animal, $sounds) ? $sounds[$animal] : array();
    }

    /**
     * Return animals known to make a sound.
     *
     * @param string $sound
     *
     * @return array
     */
    public static function animalsForSound($sound)
    {
        $sound = strtolower(trim((string) $sound));
        $animals = array();

        foreach (self::all() as $animal => $sounds) {
            if (in_array($sound, $sounds, true)) {
                $animals[] = $animal;
            }
        }

        return $animals;
    }

    /**
     * Return a random known sound for an animal, or null if unknown.
     *
     * @param string $animal
     *
     * @return string|null
     */
    public static function randomSoundFor($animal)
    {
        $sounds = self::soundsFor($animal);

        return $sounds ? $sounds[array_rand($sounds)] : null;
    }
}
