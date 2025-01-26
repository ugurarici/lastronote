<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Directory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DirectoryController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        auth()->user()->directories()->create($validated);

        return response()->json(['message' => 'Directory created']);
    }

    public function update(Request $request, Directory $directory): JsonResponse
    {
        abort_unless($directory->user_id === auth()->id(), 403);
        abort_if($directory->is_default, 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $directory->update($validated);

        return response()->json(['message' => 'Directory updated']);
    }

    public function destroy(Directory $directory): JsonResponse
    {
        abort_unless($directory->user_id === auth()->id(), 403);
        abort_if($directory->is_default, 403);

        $directory->delete();

        return response()->json(['message' => 'Directory deleted']);
    }
}