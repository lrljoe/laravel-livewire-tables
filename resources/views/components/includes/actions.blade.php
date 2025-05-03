@aware(['isTailwind', 'isBootstrap'])
@php($actionWrapperAttributes = $this->getActionWrapperAttributes())
@php($actionsPosition = $this->getActionsPosition())
@php($showActionsInToolbar = $this->showActionsInToolbar())

<div {{ $attributes
            ->merge($actionWrapperAttributes)
            ->class([
                'flex flex-cols py-2 space-x-2' => $isTailwind && ($actionWrapperAttributes['default-styling'] ?? true),
                '' => $isTailwind && ($actionWrapperAttributes['default-colors'] ?? true),
                'd-flex flex-cols py-2 space-x-2' => $isBootstrap && ($actionWrapperAttributes['default-styling'] ?? true),
                '' => $isBootstrap && ($actionWrapperAttributes['default-colors'] ?? true),
                'justify-start' => $actionsPosition === 'left',
                'justify-center' => $actionsPosition === 'center',
                'justify-end' => $actionsPosition === 'right',
                'pl-2' => $showActionsInToolbar && $actionsPosition === 'left',
                'pr-2' => $showActionsInToolbar && $actionsPosition === 'right',
            ])
            ->except(['default','default-styling','default-colors'])
        }} >
    @foreach($this->getActions() as $action)
        {{ $action->render() }}
    @endforeach
</div>
