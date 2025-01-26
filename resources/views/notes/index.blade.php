<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Notlarım') }}
            </h2>
            <a href="{{ route('notes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Yeni Not') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($notes->isEmpty())
                        <p class="text-center text-gray-500">{{ __('Henüz not eklenmemiş.') }}</p>
                    @else
                        <div class="space-y-4">
                            @foreach($notes as $note)
                                <div class="border-b pb-4 last:border-b-0 last:pb-0">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <a href="{{ route('notes.show', $note) }}" class="text-lg font-semibold hover:text-blue-600">
                                                {{ $note->title }}
                                            </a>
                                            <p class="text-sm text-gray-600 mt-1">
                                                {{ Str::limit($note->content, 100) }}
                                            </p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('notes.edit', $note) }}" class="text-blue-500 hover:text-blue-700">
                                                {{ __('Düzenle') }}
                                            </a>
                                            <form action="{{ route('notes.destroy', $note) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('{{ __('Bu notu silmek istediğinizden emin misiniz?') }}')">
                                                    {{ __('Sil') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-2">
                                        {{ $note->created_at->format('d.m.Y H:i') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            {{ $notes->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>