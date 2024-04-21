<x-layout>
  <x-slot:heading>
      Job details
  </x-slot:heading>
 <h1 class="font-bold text-lg"> {{$job->title}}</h1>
 <p>
  This job pays {{$job->salary}} per year
 </p>
  @can('edit-job', $job)
    <div class="mt-6">
      <x-button href="{{'/jobs/'.$job->id.'/edit'}}">Edit</x-button>
    </div>
  @endcan
</x-layout>