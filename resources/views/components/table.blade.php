@aware(['tableName','isTailwind','isBootstrap'])
@props(['bulkActionsTdAttributes','bulkActionsTdCheckboxAttributes'])

@php($coreTableAttributes = $this->getCoreTableAttributes())

@if ($isTailwind)
    <div {{ $attributes->merge($coreTableAttributes['wrapper'])
            ->class([
                'border-gray-200 dark:border-gray-700' => $coreTableAttributes['wrapper']['default-colors'] ?? ($coreTableAttributes['wrapper']['default'] ?? false),
                'shadow overflow-y-auto border-b sm:rounded-lg' => $coreTableAttributes['wrapper']['default-styling'] ?? ($coreTableAttributes['wrapper']['default'] ?? false),
            ])
            ->except(['default','default-styling','default-colors'])
    }}>
        <table {{ $attributes->merge($coreTableAttributes['table'])
                ->class([
                    'divide-gray-200 dark:divide-none' => $coreTableAttributes['table']['default-colors'] ?? ($coreTableAttributes['table']['default'] ?? true),
                    'min-w-full divide-y' => $coreTableAttributes['table']['default-styling'] ?? ($coreTableAttributes['table']['default'] ?? true),
                ])
                ->except(['default','default-styling','default-colors']) }}
        >
            <thead {{ $attributes->merge($coreTableAttributes['thead'])
                    ->class([
                        'bg-gray-50 dark:bg-gray-800' => $coreTableAttributes['thead']['default-colors'] ?? ($coreTableAttributes['thead']['default'] ?? true),
                        '' => $coreTableAttributes['thead']['default-styling'] ?? ($coreTableAttributes['thead']['default'] ?? true),
                    ])
                    ->except(['default','default-styling','default-colors']) }}
            >
                <tr>
                    {{ $thead }}
                </tr>
            </thead>

            {{ $slot }}


            @isset($tfoot)
                <tfoot wire:key="{{ $tableName }}-tfoot">
                    {{ $tfoot }}
                </tfoot>
            @endisset
        </table>
    </div>
@elseif ($isBootstrap)
    <div {{ $attributes->merge($coreTableAttributes['wrapper'])
            ->class([
                '' => $coreTableAttributes['wrapper']['default-colors'] ?? ($coreTableAttributes['wrapper']['default'] ?? true),
                'table-responsive' => $coreTableAttributes['wrapper']['default-styling'] ?? ($coreTableAttributes['wrapper']['default'] ?? true),
            ])
            ->except(['default','default-styling','default-colors']) 
        }}
    >
        <table {{ $attributes->merge($coreTableAttributes['table'])
                ->class([
                    '' => $coreTableAttributes['table']['default-colors'] ?? ($coreTableAttributes['table']['default'] ?? true),
                    'laravel-livewire-table table' => $coreTableAttributes['table']['default-styling'] ?? ($coreTableAttributes['table']['default'] ?? true),
                ])
                ->except(['default','default-styling','default-colors'])
            }}
        >
            <thead {{ $attributes->merge($coreTableAttributes['thead'])
                    ->class([
                        '' => $coreTableAttributes['thead']['default-colors'] ?? ($coreTableAttributes['thead']['default'] ?? true),
                        '' => $coreTableAttributes['thead']['default-styling'] ?? ($coreTableAttributes['thead']['default'] ?? true),
                    ])
                    ->except(['default','default-styling','default-colors']) }}
            >
                <tr>
                    {{ $thead }}
                </tr>
            </thead>

            <tbody {{ $attributes->merge($coreTableAttributes['tbody'])
                    ->class([
                        '' => $coreTableAttributes['tbody']['default-colors'] ?? ($coreTableAttributes['tbody']['default'] ?? true),
                        '' => $coreTableAttributes['tbody']['default-styling'] ?? ($coreTableAttributes['tbody']['default'] ?? true),
                    ])
                    ->except(['default','default-styling','default-colors']) }}
            >
                {{ $slot }}
            </tbody>

            @isset($tfoot)
                <tfoot wire:key="{{ $tableName }}-tfoot">
                    {{ $tfoot }}
                </tfoot>
            @endisset
        </table>
    </div>
@endif
