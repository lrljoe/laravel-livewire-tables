<?php

namespace Rappasoft\LaravelLivewireTables\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Features\SupportConsoleCommands\Commands\ComponentParser;
use Livewire\Features\SupportConsoleCommands\Commands\MakeCommand as LivewireMakeCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

use function Laravel\Prompts\suggest;
use function Laravel\Prompts\text;

/**
 * Class MakeCommand
 */
class MakeCommand extends Command implements PromptsForMissingInput
{
    protected ComponentParser $parser;

    /**
     * @var string
     */
    protected $model;

    protected ?Model $modelInstance;

    protected string $booleanFilters = '';

    /**
     * @var string|null
     */
    protected $modelPath;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:datatable
        {name : The name of your Livewire class}
        {model : The name of the model you want to use in this table}
        {modelpath? : The name of the model you want to use in this table}
        {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a Laravel Livewire Datatable class.';

    /**
     * Generate the Datatable component
     */
    public function handle(): void
    {

        
        $this->parser = new ComponentParser(
            config('livewire.class_namespace'),
            config('livewire.view_path'),
            $this->argument('name')
        );

        $livewireMakeCommand = new LivewireMakeCommand;

        if ($livewireMakeCommand->isReservedClassName($name = $this->parser->className())) {
            $this->line("<fg=red;options=bold>Class is reserved:</> {$name}");

            return;
        }

        $this->model = Str::studly($this->argument('model'));
        $this->modelPath = $this->argument('modelpath') ?? null;

        $force = $this->option('force');

        $this->createClass($force);

        $this->info('Livewire Datatable Created: '.$this->parser->className());
    }

    protected function createClass(bool $force = false): bool
    {
        $classPath = $this->parser->classPath();

        if (! $force && File::exists($classPath)) {
            $this->line("<fg=red;options=bold>Class already exists:</> {$this->parser->relativeClassPath()}");

            return false;
        }

        $this->ensureDirectoryExists($classPath);

        File::put($classPath, $this->classContents());

        return $classPath;
    }

    protected function ensureDirectoryExists(string $path): void
    {
        if (! File::isDirectory(dirname($path))) {
            File::makeDirectory(dirname($path), 0777, true, true);
        }
    }

    public function classContents(): string
    {
        return str_replace(
            ['[namespace]', '[class]', '[model]', '[model_import]', '[columns]', '[filters]'],
            [$this->parser->classNamespace(), $this->parser->className(), $this->model, $this->getModelImport(), $this->generateColumns($this->getModelImport()), "[\n".$this->booleanFilters."\n        ]"],
            file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'table.stub')
        );
    }

    public function getModelImport(): string
    {
        if (File::exists(app_path('Models/'.$this->model.'.php'))) {
            return 'App\Models\\'.$this->model;
        }

        if (File::exists(app_path($this->model.'.php'))) {
            return 'App\\'.$this->model;
        }

        if (isset($this->modelPath)) {
            $filename = rtrim($this->modelPath, '/').'/'.$this->model.'.php';
            if (File::exists($filename)) {
                // In case the file has more than one class which is highly unlikely but still possible
                $classes = array_filter($this->getClassesList($filename), function ($class) {
                    return substr($class, strrpos($class, '\\') + 1) == $this->model;
                });
                if (count($classes) == 1) {
                    return $classes[0];
                }
            }
        }

        $this->error('Could not find path to model.');

        return 'App\Models\\'.$this->model;
    }

    /**
     * Undocumented function
     * Credits to Harm Smits: https://stackoverflow.com/a/67099502/2263114
     * 
     * @param string $file
     * 
     * @return array<mixed>
     */
    private function getClassesList(string $file): array
    {
        $classes = [];
        $namespace = '';
        $fileContents = file_get_contents($file);

        $tokens = \PhpToken::tokenize($fileContents);

        for ($i = 0; $i < count($tokens); $i++) {
            if ($tokens[$i]->getTokenName() === 'T_NAMESPACE') {
                for ($j = $i + 1; $j < count($tokens); $j++) {
                    if ($tokens[$j]->getTokenName() === 'T_NAME_QUALIFIED') {
                        $namespace = $tokens[$j]->text;
                        break;
                    }
                }
            }

            if ($tokens[$i]->getTokenName() === 'T_CLASS') {
                for ($j = $i + 1; $j < count($tokens); $j++) {
                    if ($tokens[$j]->getTokenName() === 'T_WHITESPACE') {
                        continue;
                    }

                    if ($tokens[$j]->getTokenName() === 'T_STRING') {
                        $classes[] = $namespace.'\\'.$tokens[$j]->text;
                    } else {
                        break;
                    }
                }
            }
        }

        return $classes;
    }

    /**
     * @throws \Exception
     */
    private function generateColumns(string $modelName): string
    {
        $booleanFields = [];
        $dateFields = [];
        $arrayFields = [];
        $foreignKeys = [];
        $timestamps = [];
        $castFields = [];

        try {
            $model = new $modelName;
            if ($model instanceof Model === false) {
                throw new \Exception('Invalid model given.');
            }
            else
            {
                $this->modelInstance = $model;
            }
        }
        catch (\Exception $e)
        {
            throw new \Exception('Invalid model given.');
        }

            $reflectionClass = new \ReflectionClass($modelName);
            $withs = $reflectionClass->getProperty('with')->getDefaultValue() ?? [];
            $withCounts = $reflectionClass->getProperty('withCount')->getDefaultValue() ?? [];

            $foreignKeys = $this->getDatabaseForeignKeys($this->modelInstance->getTable());
            $timestamps = $this->getDateColumns();        
            $searchableFields = $this->getDatabaseSearchableFields($this->modelInstance->getTable());

            $castFields = [...$timestamps, ...$this->modelInstance->getCasts() ?? []];

            foreach ($castFields as $field => $cast) {
                if(substr($cast, 0,8) == 'datetime')
                {
                    $dateFormat = substr($cast, 9);
                    $dateFields[$field] = strlen($dateFormat) > 1 ? $dateFormat : 'Y-m-d H:i:s';
                }
                elseif(substr($cast, 0,7) == 'boolean')
                {
                    $booleanFields[] = $field;
                    $this->booleanFilters .= $this->createBooleanFilter($field);
                }
                elseif(substr($cast, 0,4) == 'json' || substr($cast,0,5) == 'array')
                {
                    $arrayFields[] = $field;
                }
            }

            $getFillable = [
                ...[$this->modelInstance->getKeyName()],
                ...$this->modelInstance->getFillable(),
                ...array_keys($timestamps),
            ];

            $columns = "[\n";

            foreach ($getFillable as $field) {
                $newColumn = '';
                if (in_array($field, $this->modelInstance->getHidden())) {
                    continue;
                }
                if (in_array($field, $foreignKeys)) {
                    continue;
                }
                $title = Str::of($field)->replace('_', ' ')->title();


                if(array_key_exists($field, $dateFields))
                {
                    $newColumn = '            DateColumn::make("'.$title.'", "'.$field.'")'."\n";
                    $newColumn .= '                ->inputFormat("'.$dateFields[$field].'")'."\n";
                    $newColumn .= '                ->outputFormat("Y-m-d H:i")'."\n";
                    $newColumn .= '                ->sortable()';
                    $newColumn .= ','."\n";
                }
                elseif(in_array($field,$booleanFields))
                {
                    $newColumn = '            BooleanColumn::make("'.$title.'", "'.$field.'")'."\n";
                    $newColumn .= '                ->setSuccessValue(true)'."\n";
                    $newColumn .= '                ->sortable()';
                    $newColumn .= ','."\n";
                }
                elseif(in_array($field,$arrayFields))
                {
                    $newColumn = '            ArrayColumn::make("'.$title.'", "'.$field.'")'."\n";
                    if(in_array($field,$searchableFields))
                    {
                        $newColumn .= '                ->searchable()'."\n";
                    }
                    $newColumn .= '                ->data(fn($value, $row) => ($row->'.$field.'  ?? []))'."\n";
                    $newColumn .= '                ->outputFormat(fn($index, $value) => $value)'."\n";
                    $newColumn .= '                ->emptyValue("Unknown")'."\n";
                    $newColumn .= '                ->separator("<br />")';
                    $newColumn .= ','."\n";
                }
                else
                {
                    $newColumn = '            Column::make("'.$title.'", "'.$field.'")'."\n";
                    if(in_array($field,$searchableFields))
                    {
                        $newColumn .= '                ->searchable()'."\n";
                    }
                    $newColumn .= '                ->sortable()';
                    $newColumn .= ','."\n";
                }

                $columns .= $newColumn;
            }

            if(!empty($withCounts))
            {
                foreach($withCounts as $index => $val) 
                {
                    $val = $val."_count";
                    $title = Str::of($val)->replace('_', ' ')->title();
                    $newColumn = '            Column::make("'.$title.'", "'.$val.'")'."\n";
                    $newColumn .= '                ->sortable()'."\n";
                    $newColumn .= '                ->label(fn ($row, Column $column) => $row->'.$val.'),'."\n";
                    $columns .= $newColumn;
                }
            }


            $columns .= '        ]';
            return $columns;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    protected function possibleModels(): array
    {
        $modelPath = is_dir(app_path('Models')) ? app_path('Models') : app_path();

        return collect(Finder::create()->files()->depth(0)->in($modelPath))
            ->map(fn ($file) => $file->getBasename('.php'))
            ->sort()
            ->values()
            ->all();
    }

    protected function promptForMissingArguments(InputInterface $input, OutputInterface $output): void
    {

        if ($this->didReceiveOptions($input)) {
            return;
        }

        if (trim($this->argument('name')) === '') {
            $name = text('What is the name of your Livewire class?', 'TestTable');

            if ($name) {
                $input->setArgument('name', $name);
            }
        }

        if (trim($this->argument('model')) === '') {
            $model = suggest(
                'What is the name of the model you want to use in this table?',
                $this->possibleModels(),
                'Test'
            );

            if ($model) {
                $input->setArgument('model', $model);
            }
        }

        if (trim($this->argument('modelpath')) === '' && ! in_array($this->argument('model'), $this->possibleModels())) {

            $modelPath = text('What is the path to the model you want to use in this table?', 'app/TestModels/');

            if ($modelPath) {
                $input->setArgument('modelpath', $modelPath);
            }
        }
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    protected function getDateColumns(): array
    {
        $defaultDateFormat = $this->modelInstance->getDateFormat();
        $timestamps = [$this->modelInstance->getCreatedAtColumn() => 'datetime:'.$defaultDateFormat, $this->modelInstance->getUpdatedAtColumn() => 'datetime:'.$defaultDateFormat];
        if(method_exists($this->modelInstance, 'getDeletedAtColumn'))
        {
            $timestamps[$this->modelInstance->getDeletedAtColumn()] = 'datetime:'.$defaultDateFormat;
        }
        return $timestamps;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    protected function getDatabaseForeignKeys(string $table): array
    {
        $data = DB::connection('mysql')->select("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE REFERENCED_TABLE_SCHEMA = (SELECT DATABASE()) AND TABLE_NAME = '$table'");
        $foreignKeys = [];
        foreach($data as $key => $item){ 
            $foreignKeys[] = $item->COLUMN_NAME;
        }
        return $foreignKeys;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    protected function getDatabaseSearchableFields(string $table): array
    {
        $data = DB::connection('mysql')->select("SHOW INDEX FROM `$table`");
        $searchableFields = [];
        foreach($data as $key => $item){ 
            $searchableFields[] = $item->Column_name;
        }
        $searchableFields = array_unique($searchableFields);
        return $searchableFields;
    }

    protected function createBooleanFilter(string $field): string
    {
        $title = Str::of($field)->replace('_', ' ')->title();
        $newFilter = '            BooleanFilter::make("'.$title.'", "'.$field.'")'."\n";
        $newFilter .= '                ->filter(function (Builder $builder, bool $value) {'."\n";
        $newFilter .= '                    $builder->where("'.$field.'", $value);'."\n";
        $newFilter .= '                }),'."\n";
        return $newFilter;
    }
}
