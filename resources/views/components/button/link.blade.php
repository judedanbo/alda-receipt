
<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'bg-green-50 rounded-md text-green-700 text-sm leading-5 font-medium focus:outline-none focus:text-green-800 focus:underline transition duration-150 ease-in-out border-b-4 border-transparent hover:border-green-500 py-1 px-2' . ($attributes->get('disabled') ? ' opacity-75 cursor-not-allowed' : ''),
    ]) }}
>
    {{ $slot }}
</button>
