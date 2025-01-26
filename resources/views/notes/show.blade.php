<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ isset($note) ? $note->title : __('Yeni Not') }}
            </h2>
            @if(isset($note))
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
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div x-data="{ showSidebar: false }" class="relative">
                <!-- Mobil Menü Butonu -->
                <button @click="showSidebar = !showSidebar"
                        class="md:hidden fixed bottom-4 right-4 bg-blue-500 text-white p-3 rounded-full shadow-lg z-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Ana İçerik Container -->
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Sidebar -->
                    <div :class="{'translate-x-0': showSidebar, '-translate-x-full': !showSidebar}"
                         class="w-full md:w-1/4 fixed md:static inset-0 bg-gray-100 md:bg-transparent md:translate-x-0 transform transition-transform duration-200 ease-in-out z-40 overflow-y-auto md:overflow-visible">
                        <div class="p-4 md:p-0">
                            <x-notes-sidebar />
                        </div>
                    </div>

                    <!-- Overlay -->
                    <div x-show="showSidebar"
                         @click="showSidebar = false"
                         class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden">
                    </div>

                    <!-- Main Content -->
                    <div class="flex-1 w-full md:flex-1">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                @if(request()->routeIs('notes.create'))
                                    <form action="{{ route('notes.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="directory_id" value="{{ $directory_id }}">
                                        <div class="mb-4">
                                            <label for="title" class="block text-sm font-medium text-gray-700">{{ __('Başlık') }}</label>
                                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            @error('title')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="content" class="block text-sm font-medium text-gray-700">{{ __('İçerik') }}</label>
                                            <textarea name="content" id="content" rows="10"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('content') }}</textarea>
                                            @error('content')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="flex items-center justify-end space-x-3">
                                            <a href="{{ route('notes.index') }}" class="text-gray-600 hover:text-gray-900">
                                                {{ __('İptal') }}
                                            </a>
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                {{ __('Kaydet') }}
                                            </button>
                                        </div>
                                    </form>
                                @else
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
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>