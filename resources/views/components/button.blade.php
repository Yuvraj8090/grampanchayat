<button {{ $attributes->merge([
    'type' => 'submit', 
    'class' => 'btn btn-dark fw-semibold text-uppercase shadow-sm'
]) }} style="font-size: 0.75rem; letter-spacing: 0.05em; transition: all 0.15s ease-in-out;">
    {{ $slot }}
</button>