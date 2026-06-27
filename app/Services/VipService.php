<?php

namespace App\Services;

use App\Models\User;

class VipService
{
    public function activate(User $user, int $months): void
    {
        if (
            $user->membership_type === 'vip' &&
            $user->vip_expires_at &&
            $user->vip_expires_at->isFuture()
        ) {
            $expire = $user->vip_expires_at;
        } else {
            $expire = now();
        }

        $user->update([
            'membership_type' => 'vip',
            'vip_expires_at' => $expire
                ->copy()
                ->addMonths($months),
        ]);
    }
}