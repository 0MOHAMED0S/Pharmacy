
<a class="dropdown-item" {{ $attributes->merge(['class' => 'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out']) }}>
    <i class="fa fa-power-off me-1 ms-1"></i>
    {{ $slot }}
</a>
