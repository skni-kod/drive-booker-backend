<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    public function update(User $user, Event $event): bool
    {
        return $user->drivers()->where('id', $event->user_id)->exists();
    }

    public function delete(User $user, Event $event): bool
    {
        return $user->drivers()->where('id', $event->user_id)->exists();
    }
}
