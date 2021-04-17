
<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'bg-red-50 rounded-md text-red-500 text-sm font-medium focus:outline-none focus:text-red-600 focus:underline transition duration-150 ease-in-out border-b-4 border-transparent hover:border-red-400 py-1 px-2' . ($attributes->get('disabled') ? ' opacity-75 cursor-not-allowed' : ''),
    ]) }}
>
    {{ $slot }}
</button>
