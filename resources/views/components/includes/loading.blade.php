@aware(['tableName','isTailwind','isTailwind4','isBootstrap'])
@props(['colCount' => 1, 'loadingPlaceholderDetails'])


<tbody data-id="loading">
    <tr wire:key="{{ $tableName }}-loader" wire:loading.class.remove="hidden d-none" {{
        $attributes->merge($loadingPlaceholderDetails['loaderRow'])
            ->class([
                // Tailwind 3
                'hidden w-full text-center place-items-center align-middle' => $isTailwind && ($loadingPlaceholderDetails['loaderRow']['default'] ?? true),
                
                // Tailwind 4
                'hidden w-full text-center place-items-center align-middle' => $isTailwind4 && ($loadingPlaceholderDetails['loaderRow']['default'] ?? true),

                // Bootstrap
                'd-none w-100 text-center align-items-center' => $isBootstrap && ($loadingPlaceholderDetails['loaderRow']['default'] ?? true),

                // All
                'unsortable'
            ])
            ->except(['default','default-styling','default-colors'])
    }} >
        <td colspan="100" wire:key="{{ $tableName }}-loader-column" {{
            $attributes->merge($loadingPlaceholderDetails['loaderCell'])
                ->class([
                    // Tailwind 3
                    'py-4' => $isTailwind && ($loadingPlaceholderDetails['loaderCell']['default'] ?? true),

                    // Tailwind 4
                    'py-4' => $isTailwind4 && ($loadingPlaceholderDetails['loaderCell']['default'] ?? true),

                    // Bootstrap
                    'py-4' => $isBootstrap && ($loadingPlaceholderDetails['loaderCell']['default'] ?? true),
                ])
                ->except(['default','default-styling','default-colors', 'colspan','wire:key'])
        }}>
            @if($loadingPlaceholderDetails['hasLoadingPlaceholderBlade'])
                @include($this->loadingPlaceholderDetails['loadingPlaceHolderBlade'], ['colCount' => $colCount])
            @else
                <div class="h-min self-center align-middle text-center">
                    <div class="lds-hourglass" {{
                            $attributes->merge($loadingPlaceholderDetails['loaderIcon'])
                                ->class([
                                    // Tailwind 3
                                    'lds-hourglass' => $isTailwind && ($loadingPlaceholderDetails['loaderIcon']['default'] ?? true),
                                    
                                    // Tailwind 4
                                    'lds-hourglass' => $isTailwind4 && ($loadingPlaceholderDetails['loaderIcon']['default'] ?? true),

                                    // Bootstrap
                                    'lds-hourglass' => $isBootstrap && ($loadingPlaceholderDetails['loaderIcon']['default'] ?? true),
                                ])
                                ->except(['default','default-styling','default-colors'])
                    }}></div>
                    <div>{!! $loadingPlaceholderDetails['loadingPlaceholderContent'] !!}</div>
                </div>
            @endif
        </td>
    </tr>
</tbody>