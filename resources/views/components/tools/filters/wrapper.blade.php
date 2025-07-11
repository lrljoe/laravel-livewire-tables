<div class="grid grid-cols-12" {{ $attributes }}> 
    <div class="col-start-1 col-span-11 min-h-7">
        {{ $label }}
    </div>
    <div class="col-start-1 col-span-12">
        {{ $slot }}
    </div>
    <div class="col-start-12 row-start-1 text-right items-end justify-end min-h-7">
        {{ $clearButton }}
    </div>
</div> 