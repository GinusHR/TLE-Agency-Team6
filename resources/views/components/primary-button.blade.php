<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-violet-light border border-transparent rounded-md font-semibold text-xs text-cream uppercase tracking-widest hover:bg-violet-dark focus:bg-violet-dark active:bg-violet-dark focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
