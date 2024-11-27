<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Voucher;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VouchersCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $vouchers;
    public User $user;

    /**
     * Create a new message instance.
     *
     * @param Voucher[] $vouchers
     * @param User $user
     */
    public function __construct(array $vouchers, User $user)
    {
        $this->vouchers = $vouchers;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->view('emails.vouchers')
                    ->subject('Subida de Comprobantes')
                    ->with([
                        'vouchers' => $this->vouchers,
                        'user' => $this->user,
                    ]);
    }
}