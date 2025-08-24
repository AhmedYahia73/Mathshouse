<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Notification;
use Carbon\Carbon;

use App\trait\Notifications;

class SendNotifications extends Command
{
    protected $signature = 'notifications:send';
    protected $description = 'Send scheduled notifications using Firebase';
    use Notifications;

    public function handle()
    {
        $now = Carbon::now();

        $notifications = Notification::
            where('date', '<=', $now)
            ->where('is_sent', false)
            ->get(); 

        foreach ($notifications as $notification) {
            $device_token = $notification?->user;
            $device_token_parent = $notification?->parent;
            $tokens = $device_token?->id ? [$device_token?->id] : [];
            if(!empty($device_token_parent?->id)){
                $tokens[] = $device_token_parent?->id;
            }

            $this->sendNotificationToMany($tokens, 'Mathshouse', 'You have new notification');
            $notification->update(['is_sent' => true]);
        }

        $this->info("Notifications sent successfully.");
    }
}
