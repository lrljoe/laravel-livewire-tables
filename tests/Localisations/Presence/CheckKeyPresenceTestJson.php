<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Localisations\Presence;

use PHPUnit\Framework\Attributes\DataProvider;
use Rappasoft\LaravelLivewireTables\Tests\Localisations\BaseLocalisationCase;

final class CheckKeyPresenceTestJson extends BaseLocalisationCase
{
    #[DataProvider('localisationProviderJson')]
    public function test_can_check_presence_of_json_keys(string $locale): void
    {
        $engStrings = self::getEnJsonLocaleStrings();
        $localisedStrings = self::getJsonLocaleStrings($locale);
        foreach ($engStrings as $key => $value) {
            $this->assertNotNull($localisedStrings[$key]);
        }
    }
}
