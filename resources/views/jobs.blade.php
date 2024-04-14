<x-layout>
  <x-slot:heading>
      Jobs page
  </x-slot:heading>
  <ul>
    @foreach ($jobs as $job )
    <li>
      <a href="/jobs/{{$job['id']}}">
        <strong class="text-blue-500 hover:underline">
          {{$job['title']}}
        </strong> 
        pays: {{$job['salary']}} per year
      </a>
    </li>
    @endforeach
  </ul>
</x-layout>