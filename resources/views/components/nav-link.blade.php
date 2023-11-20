@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 white:border-indigo-600 text-sm font-medium leading-5 text-gray-900 white:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 white:text-gray-400 hover:text-gray-700 white:hover:text-gray-300 hover:border-gray-300 white:hover:border-gray-700 focus:outline-none focus:text-gray-700 white:focus:text-gray-300 focus:border-gray-300 white:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
