<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full py-3 bg-[#0063CB] text-white rounded-md shadow-lg hover:bg-[#104172] transition duration-200 font-bold transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
