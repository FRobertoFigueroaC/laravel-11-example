
@props([
  'routeName' => '/',
  'mobile' => false
  ])

  @if ($mobile)
    <a {{$attributes}}
    aria-current="{{request()->is($routeName) ? 'page' : 'false'}}"
    class="{{request()->is($routeName) ? 'bg-gray-900 text-white': 'text-gray-300 hover:bg-gray-700 hover:text-white'}} block rounded-md px-3 py-2 text-base font-medium">
      {{$slot}}
    </a>
  @else

    <a {{$attributes}}
    aria-current="{{request()->is($routeName) ? 'page' : 'false'}}"
    class="{{request()->is($routeName) ? 'bg-gray-900 text-white': 'text-gray-300 hover:bg-gray-700 hover:text-white'}} rounded-md px-3 py-2 text-sm font-medium">
      {{$slot}}
    </a>
    
  @endif



