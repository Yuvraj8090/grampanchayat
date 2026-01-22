<button {{ $attributes->merge([
    'type' => 'submit', 
    'class' => 'btn btn-dark font-semibold text-uppercase tracking-wider shadow-sm'
]) }} style="font-size: 0.75rem; transition: all 0.15s ease-in-out;">
    {{ $slot }}
</button>