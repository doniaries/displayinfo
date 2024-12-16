<?php

namespace App\Events\Quotes;

use App\Models\Quotes;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuoteUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $quote;

    public function __construct(Quotes $quote)
    {
        $this->quote = $quote;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('quotes'),
        ];
    }
}
