<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NoteController extends Controller
{
    public function index(): View
    {
        $notes = auth()->user()->notes()->latest()->paginate(10);
        return view('notes.index', compact('notes'));
    }

    public function create(): View
    {
        return view('notes.create');
    }

    public function store(NoteRequest $request): RedirectResponse
    {
        $note = auth()->user()->notes()->create($request->validated());

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
