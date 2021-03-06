<?php

namespace App\Jobs;

use App\Models\Messages\GroupInviteLink;
use App\Services\Messenger\InvitationService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CheckThreadInvites implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 1;

    public function handle()
    {
        $invites = GroupInviteLink::all();
        foreach($invites as $invite){
            InvitationService::ValidateInviteLink($invite);
        }
        return;
    }
}