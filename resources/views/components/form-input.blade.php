@props(['label', 'name', 'type' => 'text', 'value' => '', 'autocomplete' => '', 'colspan' => 'sm:col-span-3'])

<div class="{{ $colspan }}">
    <label for="{{ $name }}" class="block text-sm/6 font-medium text-gray-900">
        {{ $label }}
    </label>

    <div class="mt-2">
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        value="{{ old($name, $value) }}" autocomplete="{{ $autocomplete }}"
        @class([
            'block w-full rounded-md px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6',
            'border border-red-500 ring-1 ring-red-500' => $errors->has($name)
        ]) />

    {{-- Error message --}}
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

</div>
<br />
