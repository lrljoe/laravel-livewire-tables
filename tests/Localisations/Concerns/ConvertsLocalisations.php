<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Localisations\Concerns;

use Illuminate\Support\Facades\File;

trait ConvertsLocalisations
{
    public function getJsonLocalisedStrings($locale): array
    {
        $baseDir = __DIR__.'/../../resources/lang/json/';

        $contents = File::get($baseDir.$locale.'.json');
        $items = json_decode(json: $contents, associative: true);

        return $items;
    }

    public function getPhpLocaleString($locale): ?string
    {
        $baseDir = __DIR__.'/../../resources/lang/php/';

        $items = require $baseDir.$locale.'/core.php';

        return $items;
    }

    public function getProvisionedLocalisations(): array
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
}
