<?php

namespace Rappasoft\LaravelLivewireTables\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Features\SupportConsoleCommands\Commands\ComponentParser;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

use function Laravel\Prompts\suggest;
use function Laravel\Prompts\text;

/**
 * Class ConvertCommand
 */
class ConvertCommand extends Command implements PromptsForMissingInput
{
    protected ComponentParser $parser;


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'datatable:conversions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert Localisations.';

    /**
     * Generate the Datatable component
     */
    public function handle(): void
    {
        $this->line("Running Conversions");
        foreach($this->getProvisionedLocalisations() as $provisionedLocale)
        {
            $this->line("Provisioned Locale: ".$provisionedLocale);
            $data = $this->getPhpLocaleString($provisionedLocale);

            $items = [];
            foreach($data as $lineItem => $text)
            {
                $items['livewire-tables::'.$lineItem] = $text;
            }
            $this->line("LineItems: ".json_encode($items, 1));
            $baseDir = __DIR__.'/../../resources/lang/json/';

            $contents = File::put($baseDir.$provisionedLocale.'.json', json_encode($items,1));
        }
    }

    /**
     * Undocumented function
     *
     * @param string $locale
     * @return array<mixed>
     */
    public function getJsonLocalisedStrings(string $locale): array
    {
        $baseDir = __DIR__.'/../../resources/lang/json/';

        $contents = File::get($baseDir.$locale.'.json');
        $items = json_decode(json: $contents, associative: true);

        return $items;
    }


    /**
     * Undocumented function
     *
     * @param string $locale
     * @return array<mixed>
     */
    public function getPhpLocaleString(string $locale): array
    {
        $baseDir = __DIR__.'/../../resources/lang/php/';

        $items = require $baseDir.$locale.'/core.php';

        return $items;
    }

    /**
     * Undocumented function
     *
     * @return array<int,string>
     */
    public function getProvisionedLocalisations(): array
    {
        return [
            'ar',
            'ca',
            'da',
            'de',
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