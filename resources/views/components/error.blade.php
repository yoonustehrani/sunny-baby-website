@props(['name'])
@error($name)
    <p class="tw:text-sm tw:text-red-500 tw:p-2">{{ $message }}</p>
@enderror