<button {{ $attributes->merge([
    'type' => 'button', 
    'class' => 'btn btn-light border font-semibold text-uppercase tracking-wider shadow-sm'
]) }} style="font-size: 0.75rem;">
    {{ $slot }}
</button>