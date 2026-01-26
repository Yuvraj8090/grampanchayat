<button {{ $attributes->merge([
    'type' => 'button', 
    'class' => 'btn btn-danger font-semibold text-uppercase tracking-wider shadow-sm'
]) }} style="font-size: 0.75rem; transition: all 0.15s ease-in-out;">
    {{ $slot }}
</button>