<div class="my-2 mx-2 relative overflow-hidden rounded-md w-[272px] h-96" title="{{ $movie['title'] }}">
    <div class="relative flex-none inline-block w-[272px] h-96">
        <div class="absolute bg-gray-400 opacity-50 rounded-lg blur object-cover w-full h-full"></div>
        <a href="{{ route('movies.show', $movie['id']) }}" class="items-center relative">
            <img src="{{ $movie['poster_path'] }}" alt="poster" class="object-cover w-full h-full" alt="{{ $movie['title'] }}">
        </a>
    </div>
    <div class="absolute py-2 bottom-0 inset-x-0 bg-gray-900 text-white leading-4 opacity-90">
        <a href="{{ route('movies.show', $movie['id']) }}" class="truncate mt-2 hover:text-gray-300">{{ $movie['title'] }}</a>
        <div class="flex items-center text-sm mt-1">
            <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24"><g data-name="Layer 2"><path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/></g></svg>
            <span class="ml-1">{{ $movie['remarks'] }}</span>
            <span class="mx-2">|</span>
            <span class="text-gray-200 text-sm">{{ $movie['type'] }}</span>
        </div>
    </div>
</div>
