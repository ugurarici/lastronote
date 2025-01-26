<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">{{ __('Notlarım') }}</h3>
            <a href="{{ route('notes.create') }}" class="text-sm text-blue-500 hover:text-blue-700">
                {{ __('+ Yeni Not') }}
            </a>
        </div>

        <div class="space-y-2">
            @foreach(auth()->user()->notes()->latest()->get() as $sidebarNote)
                <a href="{{ route('notes.show', $sidebarNote) }}"
                   class="block p-2 rounded {{ request()->route('note')?->id === $sidebarNote->id ? 'bg-blue-50 border-l-4 border-blue-500' : 'hover:bg-gray-50' }}">
                    <div class="font-medium truncate">{{ $sidebarNote->title }}</div>
                    <div class="text-xs text-gray-500">
                        {{ $sidebarNote->updated_at->format('d.m.Y H:i') }}
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>