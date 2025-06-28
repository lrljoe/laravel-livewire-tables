    <div wire:key="tablestatedropdownelement">
        <select wire:model.live="savedState" class="h-min rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 rounded-none rounded-l-md focus:ring-0 focus:border-gray-300 border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:border-gray-300 block w-full">
            <option value=''>{{ __('savingtablestate::core.select_one') }}</option>
            <option value='saveNew'>{{ __('savingtablestate::core.save_new') }}</option>
            @foreach($this->getAvailableTableStates as $id => $name)
                <option value='{{ $id }}' wire:key="test-{{ $id }}">{{ $name}}</option>
            @endforeach
        </select>
    </div>