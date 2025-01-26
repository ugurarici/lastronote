<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">{{ __('Dizinler') }}</h3>
            <button type="button" x-data @click="createDirectory()" class="text-sm text-blue-500 hover:text-blue-700">
                {{ __('+ Yeni Dizin') }}
            </button>
        </div>

        <div class="space-y-2"
             x-data="{
                openDirs: JSON.parse(localStorage.getItem('openDirectories') || '[]'),
                toggleDir(id) {
                    if (this.openDirs.includes(id)) {
                        this.openDirs = this.openDirs.filter(dirId => dirId !== id);
                    } else {
                        this.openDirs.push(id);
                    }
                    localStorage.setItem('openDirectories', JSON.stringify(this.openDirs));
                }
             }">
            @foreach(auth()->user()->directories()->withCount('notes')->get() as $directory)
                <div class="border-b last:border-b-0">
                    <div class="flex items-center justify-between p-2">
                        <button @click="toggleDir({{ $directory->id }})"
                                class="flex items-center space-x-2 text-left">
                            <span class="transform transition-transform"
                                  :class="{'rotate-90': openDirs.includes({{ $directory->id }})}"
                            >▶</span>
                            <span>{{ $directory->name }}</span>
                            <span class="text-xs text-gray-500">({{ $directory->notes_count }})</span>
                        </button>

                        <div class="flex items-center space-x-2">
                            <a href="{{ route('notes.create', ['directory' => $directory->id]) }}"
                               class="text-sm text-blue-500 hover:text-blue-700">
                                {{ __('+ Not') }}
                            </a>
                            @unless($directory->is_default)
                                <button onclick="editDirectory({{ $directory->id }})"
                                        class="text-sm text-gray-500 hover:text-gray-700">
                                    {{ __('Düzenle') }}
                                </button>
                            @endunless
                        </div>
                    </div>

                    <div x-show="openDirs.includes({{ $directory->id }})"
                         x-transition
                         class="ml-6 border-l">
                        @foreach($directory->notes()->latest()->get() as $note)
                            <a href="{{ route('notes.show', $note) }}"
                               class="block p-2 hover:bg-gray-50 {{ request()->route('note')?->id === $note->id ? 'bg-blue-50 border-l-4 border-blue-500' : '' }}">
                                <div class="font-medium truncate">{{ $note->title }}</div>
                                <div class="text-xs text-gray-500">
                                    {{ $note->updated_at->format('d.m.Y H:i') }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        window.createDirectory = async function() {
            const name = prompt("{{ __('Dizin adı:') }}");
            if (name) {
                try {
                    const response = await fetch('{{ route("directories.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ name })
                    });

                    if (response.ok) {
                        window.location.reload();
                    } else {
                        alert('Dizin oluşturulurken bir hata oluştu.');
                    }
                } catch (error) {
                    console.error('Hata:', error);
                    alert('Dizin oluşturulurken bir hata oluştu.');
                }
            }
        };

        window.editDirectory = async function(id) {
            const name = prompt("{{ __('Yeni dizin adı:') }}");
            if (name) {
                try {
                    const response = await fetch(`/directories/${id}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ name })
                    });

                    if (response.ok) {
                        window.location.reload();
                    } else {
                        alert('Dizin güncellenirken bir hata oluştu.');
                    }
                } catch (error) {
                    console.error('Hata:', error);
                    alert('Dizin güncellenirken bir hata oluştu.');
                }
            }
        };
    });
</script>
@endpush