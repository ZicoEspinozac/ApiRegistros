<?php

namespace App\Listeners;

use App\Events\Vouchers\VouchersCreated;
use App\Mail\VouchersCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendVoucherAddedNotification implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  VouchersCreated  $event
     * @return void
     */
    public function handle(VouchersCreated $event): void
    {
        try {
            $mail = new VouchersCreatedMail($event->vouchers, $event->user);
            Mail::to($event->user->email)->send($mail);
            Log::info('Correo VouchersCreatedMail enviado a: ' . $event->user->email);
        } catch (\Exception $e) {
            Log::error('Error al enviar el correo de notificación: ' . $e->getMessage());
        }
    }
}