<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Localisations\Presence;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use Rappasoft\LaravelLivewireTables\Tests\Localisations\BaseLocalisationCase;

final class CheckKeyPresenceTest extends BaseLocalisationCase
{
    public static function provideCombineCases(): Generator
    {
        $provisionedLocalisations = self::provisionedLocalisations();
        $englishLocalisationStrings = self::getEnLocaleStrings();

        foreach ($englishLocalisationStrings as $enLocaleKey => $enLocaleString) {
            foreach ($provisionedLocalisations as $provisionedLocalisation) {
                yield [$enLocaleKey, $provisionedLocalisation];

            }

        }
        // yield [self::getEnLocaleStrings(), 'en'];
        // yield [self::getEnLocaleStrings(), 'fr'];
    }

    #[DataProvider('provideCombineCases')]
    public function test_can_check_presence_of_keys_for_localisation(string $enLocaleKey, string $locale): void
    {
        $localisedStrings = self::getLocaleStrings($locale);

        $this->assertArrayHasKey($enLocaleKey, $localisedStrings);

    }
}
