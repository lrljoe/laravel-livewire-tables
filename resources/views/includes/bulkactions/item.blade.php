@aware(['dataTableFingerprint','isBootstrap', 'isTailwind', 'isTailwind4'])
@if($isTailwind || $isTailwind4)
    <button {{ 
        $attributes
        ->merge([
            'wire:key' => $dataTableFingerprint.'-bulk-action-'.$action,
        ])
        ->class([
            'text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:bg-gray-100 focus:text-gray-900 dark:text-white dark:focus:text-white dark:focus:bg-gray-600 dark:hover:bg-gray-600' => $isTailwind && ($attributes['default-colors'] ?? true),
            'flex flex-cols w-full px-4 py-2 text-sm focus:outline-none items-left text-left gap-2' => $isTailwind && ($attributes['default-styling'] ?? true),
            'twp4 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:bg-gray-100 focus:text-gray-900 dark:text-white dark:hover:bg-gray-600' => $isTailwind4 && ($attributes['default-colors'] ?? true),
            'twp4 block w-full px-4 py-2 text-sm leading-5 focus:outline-none flex items-center space-x-2' => $isTailwind4 && ($attributes['default-styling'] ?? true),

        ])
        ->except(['default-colors','default-styling']) 
    }}>
        @if($icon !== '')
            <span @class([
                'w-1/12',
                'order-1' => !$iconRight,
                'order-2' => $iconRight
                ])><i class="{{ $icon }}"></i></span>
        @endif
        <span @class([
            'w-11/12 ',
            'order-2' => $icon !== '' && !$iconRight,
            'order-1' => $icon !== '' && $iconRight
            ])>{{ $title }}</span>

    </button>
@else
    <a {{ 
        $attributes->merge([
            'href' => '#',
            'wire:key' => $dataTableFingerprint.'-bulk-action-'.$action,
        ])
        ->class([
            'dropdown-item' => ($attributes['default-styling'] ?? true),
        ])
        ->except(['default-colors','default-styling'])
    }}>
        @if($icon !== '' && !$iconRight)
            <span><i class="{{ $icon }}"></i></span>
        @endif
            <span>{{ $title }}</span>
        @if($icon !== '' && $iconRight)
            <span><i class="{{ $icon }}"></i></span>
        @endif

    </a>
@endif