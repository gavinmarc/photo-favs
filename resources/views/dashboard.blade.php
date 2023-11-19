<x-app-layout>
  <x-slot name="header">
    {{ __('Dashboard') }}
  </x-slot>

  <div>
    <h3 class="text-xl text-gray-800 leading-tight">
      {{ __('Photos') }}
    </h3>

    <photo-favorite-view :initial-ids="{{ $starredIds }}"/>
  </div>
</x-app-layout>
