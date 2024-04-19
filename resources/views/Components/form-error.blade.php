@props(['name'])

@error($name)
  <span class="text-sm text-red-500 font-semibold italic mt-2">
    {{$message}}
  </span>
@enderror