@props(['name'])
@error($name)
    <p class="tw:text-sm tw:text-red-500 tw:p-2 p-2 text-sm text-red-500">{{ $message }}</p>
@enderror