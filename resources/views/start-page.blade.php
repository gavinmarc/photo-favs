<x-app-layout>
  <x-slot name="header">
    {{ __('Home') }}
  </x-slot>

  <div>
    <h3 class="text-xl text-gray-800 leading-tight">
      {{ __('Latest Favorites') }}
    </h3>

    <div class="mt-8">
      @if(count($favorites) == 0)
        <p>No photos have been marked as favorites yet. Register and be the first!</p>
      @else
        <div class="grid grid-cols-4 gap-4">
          @foreach($favorites as $favorite)
            <div>
              <img src="{{ $favorite->photo_url }}" alt=""/>
              <label>Liked by {{ $favorite->user->name }}</label>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </div>
</x-app-layout>
