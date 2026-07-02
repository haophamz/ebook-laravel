<?php

namespace App\Console\Commands;

use App\Mail\TicketClosedMail;
use App\Models\SupportTicket;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CloseInactiveSupportTickets extends Command
{
    protected $signature = 'support:close-inactive';

    protected $description = 'Tự động đóng các ticket không phản hồi sau 24 giờ';

    public function handle()
    {
        $tickets = SupportTicket::where('status', 'processing')
            ->where('last_reply_by', 'admin')
            ->whereNotNull('last_reply_at')
            ->where('last_reply_at', '<=', now()->subHours(24))
            ->get();

        $this->info('Found: ' . $tickets->count() . ' ticket(s)');

        foreach ($tickets as $ticket) {

            $ticket->update([
                'status'    => 'closed',
                'closed_at' => now(),
            ]);

            try {

                Mail::to($ticket->email)
                    ->send(new TicketClosedMail($ticket));

                $this->info("Mail sent to {$ticket->email}");

            } catch (\Throwable $e) {

                $this->error("Mail failed Ticket #{$ticket->id}: " . $e->getMessage());

            }

            $this->info("Closed Ticket #{$ticket->id}");
        }

        $this->info('Done!');
    }
}