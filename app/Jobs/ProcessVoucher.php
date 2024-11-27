<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\VoucherService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessVoucher implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $xmlContent;
    protected $user;

    /**
     * Create a new job instance.
     */
    public function __construct(string $xmlContent, User $user)
    {
        $this->xmlContent = $xmlContent;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(VoucherService $voucherService): void
    {
        try {
            $voucherService->storeVoucherFromXmlContent($this->xmlContent, $this->user);
            Log::info('Voucher processed successfully for user: ' . $this->user->id);
        } catch (\Exception $e) {
            Log::error('Failed to process voucher for user: ' . $this->user->id . '. Error: ' . $e->getMessage());
            // Aquí puedes agregar lógica adicional para manejar el error, como enviar un correo de notificación
        }
    }
}