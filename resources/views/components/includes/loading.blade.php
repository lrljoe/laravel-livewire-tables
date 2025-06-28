@aware(['dataTableFingerprint','isTailwind','isTailwind4','isBootstrap'])
@props(['colCount' => 1, 'loadingPlaceholderDetails'])


<tbody data-id="loading">
    <tr wire:key="{{ $dataTableFingerprint }}-loader" wire:loading.class.remove="hidden d-none" {{
        $attributes->merge($loadingPlaceholderDetails['loaderRow'])
            ->class([
                'hidden w-full text-center place-items-center align-middle' => $isTailwind && ($loadingPlaceholderDetails['loaderRow']['default'] ?? true),
                'tw4ph hidden w-full text-center place-items-center align-middle' => $isTailwind4 && ($loadingPlaceholderDetails['loaderRow']['default'] ?? true),
                'd-none w-100 text-center align-items-center' => $isBootstrap && ($loadingPlaceholderDetails['loaderRow']['default'] ?? true),

                'unsortable'
            ])
            ->except(['default','default-styling','default-colors'])
    }} >
        <td colspan="100" wire:key="{{ $dataTableFingerprint }}-loader-column" {{
            $attributes->merge($loadingPlaceholderDetails['loaderCell'])
                ->class([
                    'py-4' => $isTailwind && ($loadingPlaceholderDetails['loaderCell']['default'] ?? true),
                    'tw4ph py-4' => $isTailwind4 && ($loadingPlaceholderDetails['loaderCell']['default'] ?? true),
                    'bs py-4' => $isBootstrap && ($loadingPlaceholderDetails['loaderCell']['default'] ?? true),
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
                                    'lds-hourglass' => $isTailwind && ($loadingPlaceholderDetails['loaderIcon']['default'] ?? true),
                                    'tw4ph lds-hourglass' => $isTailwind4 && ($loadingPlaceholderDetails['loaderIcon']['default'] ?? true),
                                    'bs lds-hourglass' => $isBootstrap && ($loadingPlaceholderDetails['loaderIcon']['default'] ?? true),
                                ]) 
                                ->except(['default','default-styling','default-colors'])
                    }}></div>
                    <div>{!! $loadingPlaceholderDetails['loadingPlaceholderContent'] !!}</div>
                </div>
            @endif
        </td>
    </tr>
</tbody>