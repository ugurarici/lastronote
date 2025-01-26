<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $note->title }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('notes.edit', $note) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Düzenle') }}
                </a>
                <form action="{{ route('notes.destroy', $note) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                        onclick="return confirm('{{ __('Bu notu silmek istediğinizden emin misiniz?') }}')">
                        {{ __('Sil') }}
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="flex gap-6">
                <!-- Sidebar -->
                <div class="w-1/4">
                    <x-notes-sidebar />
                </div>

                <!-- Main Content -->
                <div class="flex-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="prose max-w-none">
                                {{ $note->content }}
                            </div>
                            <div class="mt-4 text-sm text-gray-500">
                                {{ __('Oluşturulma:') }} {{ $note->created_at->format('d.m.Y H:i') }}
                                @if($note->updated_at->ne($note->created_at))
                                    <br>
                                    {{ __('Güncellenme:') }} {{ $note->updated_at->format('d.m.Y H:i') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>