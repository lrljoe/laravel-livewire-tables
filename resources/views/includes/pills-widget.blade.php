<div wire:ignore.self>
    <div>Pills Widget</div>

    <div class="flex flex-col" x-data="{ filterVals: $wire.$parent.appliedFilters }">

        <ul>
        TEST12
            <template x-for="(value, index) in filterVals">
                <li>
                    <span x-text="value"></span>
                </li>
            </template>

        </ul>
        @forelse($this->filters as $key => $values)
            <div><span>@if($values['titleAsHTML']) {!! $values['title'] !!} @else {{ $values['title']}} @endif</span>
            <span>Stuff</span>


            </div>
        @empty
            <div>No Filter Pills</div>
        @endforelse

    </div>
</div>