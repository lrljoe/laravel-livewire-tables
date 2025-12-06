<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Localisations;

use Generator;
use Illuminate\Support\Facades\File;
use PHPUnit\Framework\Attributes\DataProvider;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class BaseLocalisationCase extends TestCase
{
    public static function getEnLocaleStrings(): array
    {
        $baseDir = __DIR__.'/../../resources/lang/php/';

        $items = require $baseDir.'en/core.php';

        return $items;
    }

    public static function getLocaleString($locale, $key): ?string
    {
        $baseDir = __DIR__.'/../../resources/lang/php/';

        $items = require $baseDir.$locale.'/core.php';

        return $items[$key] ?? null;
    }

    public static function getLocaleStrings($locale): array
    {
        $baseDir = __DIR__.'/../../resources/lang/php/';

        $items = require $baseDir.$locale.'/core.php';

        return $items;
    }

    public static function getEnJsonLocaleStrings(): array
    {
        $baseDir = __DIR__.'/../../resources/lang/json/';

        $contents = File::get($baseDir.'en.json');
        $items = json_decode(json: $contents, associative: true);

        return $items;
    }

    public static function getJsonLocaleStrings($locale): array
    {
        $baseDir = __DIR__.'/../../resources/lang/json/';

        $contents = File::get($baseDir.$locale.'.json');
        $items = json_decode(json: $contents, associative: true);

        return $items;
    }

    public static function provisionedLocalisations(): array
    {
        return [
            'ar',
            'ca',
            'da',
            'de',
            'en',
            'es',
            'fr',
            'id',
            'it',
            'ms',
            'nb',
            'nl',
            'pl',
            'pt',
            'pt_BR',
            'ru',
            'sq',
            'sv',
            'th',
            'tk',
            'tr',
            'tw',
            'uk',
        ];
    }

    public static function localisationProvider(): array
    {
        $baseDir = __DIR__.'/../../resources/lang/php/';

        $localisations = [];

        $availableLocales = [
            'ar',
            'ca',
            'da',
            'de',
            'en',
            'es',
            'fr',
            'id',
            'it',
            'ms',
            'nb',
            'nl',
            'pl',
            'pt',
            'pt_BR',
            'ru',
            'sq',
            'sv',
            'th',
            'tk',
            'tr',
            'tw',
            'uk',
        ];
        // return $availableLocales;

        foreach ($availableLocales as $availableLocale) {
            // $array = require($baseDir.$availableLocale.'/core.php');
            $localisations[] = [
                'locale' => $availableLocale,
                //      'localisationStrings' => $array,
            ];
        }

        return $localisations;
    }

    public static function localisationProviderList()
    {
        $locales = [];
        $locales[] = ['locale' => 'en', 'keys' => array_keys(self::getEnLocaleStrings())];

        return $locales;
    }

    public static function localisationKeyList()
    {
        $tem = self::getEnLocaleStrings();
        $keys = [];
        foreach ($tem as $key => $val) {
            $keys[] = $key;
        }

        return $keys;
    }

    public static function localisationEnglishStrings(): array
    {
        return ['keys' => array_keys(self::getEnLocaleStrings())];
    }

    public static function localisationProviderFull(): array
    {
        $baseDir = __DIR__.'/../../resources/lang/php/';
        $localisations = [];

        $localisations = [
            'es',
        ];
        // return $availableLocales;

        return $localisations;
    }

    public static function localisationProviderJson(): array
    {
        $baseDir = __DIR__.'/../../resources/lang/json/';

        $localisations = [];

        $availableLocales = [
            'ar',
            'ca',
            'da',
            'de',
            'en',
            'es',
            'fr',
            'id',
            'it',
            'ms',
            'nb',
            'nl',
            'pl',
            'pt',
            'pt_BR',
            'ru',
            'sq',
            'sv',
            'th',
            'tk',
            'tr',
            'tw',
            'uk',
        ];
        // return $availableLocales;

        foreach ($availableLocales as $availableLocale) {
            // $array = require($baseDir.$availableLocale.'/core.php');
            $localisations[] = [
                'locale' => $availableLocale,
                //      'localisationStrings' => $array,
            ];
        }

        return $localisations;
    }
}
