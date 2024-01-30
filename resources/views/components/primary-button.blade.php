<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full items-center hover:scale-105 transition py-3 bg-purple-900 border text-white border-transparent rounded-md font-medium text-sm uppercase tracking-widest ']) }}>
    {{ $slot }}
</button>
