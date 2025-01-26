<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function created(User $user): void
    {
        $user->directories()->create([
            'name' => 'Notlarım',
            'is_default' => true
        ]);
    }
}