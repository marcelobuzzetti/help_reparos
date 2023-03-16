<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AtualizacaoOrdem implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $status;

    public function __construct(array $status)
    {
        $this->status = $status;
    }

    public function broadcastOn()
    {
        return new Channel('atualizacao-ordem');
    }

    public function broadcastAs()
    {
        return 'alteracao-status';
    }
}
