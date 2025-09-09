<div {{ $obscureAttributes }}>
    <div x-show="obscure">
        {{ $mask }}
    </div>
    <div x-cloak x-show="!obscure">
        {{ $value }}
    </div>
</div>
