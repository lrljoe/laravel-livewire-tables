<div >
    <div>Pills Widget</div>

    <div class="flex flex-col">
        @forelse($this->filters as $key => $values)
            <div>@if($values['titleAsHTML']) {!! $values['title'] !!} @else {{ $values['title']}} @endif</div>
            <div class="flex flex-col">
                @forelse($values as $valueKey => $value)
                    <div class="flex flex-row space-x-2">
                        <div>{{ $valueKey }}</div>
                        <div>
                            
                            @if(is_bool($value))
                                {{ intval($value) }}
                            @elseif(!is_array($value))
                                {{ $value }}
                            @else
                                @foreach($value as $valKey => $valVal)
                                    {{ $valKey}}: {{ $valVal }} <br />
                                @endforeach
                            @endif

                        </div>
                    </div>
                @empty
                    <div>No Values</div>
                @endforelse
            </div>
        @empty
            <div>No Filter Pills</div>
        @endforelse

    </div>
</div>