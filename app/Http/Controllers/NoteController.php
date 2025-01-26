<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NoteController extends Controller
{
    public function index(): RedirectResponse|View
    {
        $latestNote = auth()->user()->notes()->latest()->first();

        // Not yoksa, yeni not oluşturma sayfasına yönlendir
        if (!$latestNote) {
            return redirect()->route('notes.create');
        }

        // Not varsa, son notu göster
        return redirect()->route('notes.show', $latestNote);
    }

    private function getOrCreateDefaultDirectory()
    {
        return auth()->user()->directories()
            ->firstOrCreate(
                [
                    'user_id' => auth()->id(),
                    'is_default' => true
                ],
                [
                    'name' => 'Notlarım'
                ]
            );
    }

    public function create(): View|RedirectResponse
    {
        $defaultDirectory = $this->getOrCreateDefaultDirectory();
        $directory_id = request('directory') ?? $defaultDirectory->id;

        return view('notes.show', compact('directory_id'));
    }

    public function store(NoteRequest $request): RedirectResponse
    {
        $defaultDirectory = $this->getOrCreateDefaultDirectory();
        $directory_id = $request->directory_id ?? $defaultDirectory->id;

        $note = auth()->user()->notes()->create([
            ...$request->validated(),
            'directory_id' => $directory_id
        ]);

        return redirect()->route('notes.show', $note)
            ->with('success', 'Not başarıyla oluşturuldu.');
    }

    public function show(Note $note): View
    {
        abort_unless($note->user_id === auth()->id(), 403);
        return view('notes.show', compact('note'));
    }

    public function edit(Note $note): View
    {
        abort_unless($note->user_id === auth()->id(), 403);
        return view('notes.edit', compact('note'));
    }

    public function update(NoteRequest $request, Note $note): RedirectResponse
    {
        abort_unless($note->user_id === auth()->id(), 403);
        $note->update($request->validated());

        return redirect()->route('notes.show', $note)
            ->with('success', 'Not başarıyla güncellendi.');
    }

    public function destroy(Note $note): RedirectResponse
    {
        abort_unless($note->user_id === auth()->id(), 403);
        $note->delete();

        return redirect()->route('notes.index')
            ->with('success', 'Not başarıyla silindi.');
    }
}
