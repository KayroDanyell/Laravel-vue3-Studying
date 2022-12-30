<?php

namespace App\Jobs;

use App\Mail\newDespesa;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\Despesa;

class sendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $user;
    public $despesa;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,Despesa $despesa)
    {
        $this->user = $user;
        $this->despesa = $despesa;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::queue((new newDespesa($this->user,$this->despesa))
        ->from('theemail@gmail.com', 'emailProjeto')
        ->to('kayrodanyell@gmail.com', 'kayro')
        );
    }
}
