@aware(['dataTableFingerprint'])
<div {{ $obscureAttributes }} >
    <div x-show="obscure"  name="obscureData">
        {{ $mask }}
    </div>
    <div x-cloak x-show="!obscure" class="rowData" x-ref="localData">
        {{ $value }}
    </div>
</div>
