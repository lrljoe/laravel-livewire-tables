@aware([ 'tableName','isTailwind','isTailwind4','isBootstrap'])
@props([])

<div {{
        $attributes->merge($this->getToolBarAttributes)
        ->class([
            'md:flex md:justify-between mb-2 px-4 md:p-0' => ($isTailwind && ($this->getToolBarAttributes['default-styling'] ?? true)),
            'd-md-flex justify-content-between mb-3' => ($isBootstrap && ($this->getToolBarAttributes['default-styling'] ?? true)),
        ])
        ->except(['default','default-styling','default-colors'])
    }}
>
    <div @class([
            'd-md-flex' => $isBootstrap,
            'w-full mb-2 md:mb-0 md:w-2/4 md:flex space-y-4 md:space-y-0 md:space-x-2' => $isTailwind,
        ])
    >
        @foreach($this->getLeftToolbarItems as $index => $toolbarItem)
            @include($toolbarItem['view'], $toolbarItem['attributes'])
        @endforeach

    </div>

    <div x-cloak x-show="!currentlyReorderingStatus"
        @class([
            'd-md-flex' => $isBootstrap,
            'md:flex md:items-center space-y-4 md:space-y-0 md:space-x-2 h-full content-center items-center justify-center' => $isTailwind,
        ])
    >

        @foreach($this->getRightToolbarItems as $index => $toolbarItem)
            @include($toolbarItem['view'], $toolbarItem['attributes'])
        @endforeach


    </div>
</div>

