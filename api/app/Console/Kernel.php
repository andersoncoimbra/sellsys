<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $vendedores = \App\Models\Vendedor::all();
            foreach ($vendedores as $vendedor) {
                Mail::to($vendedor->email)->send(new \App\Mail\ComissaoDiariaMail($vendedor));
            }

            // Também envia ao administrador
            $totalGeral = \App\Models\Venda::whereDate('data', now()->toDateString())->sum('valor');
            Mail::to('admin@empresa.com')->send(new \App\Mail\ResumoAdminMail($totalGeral));
        })->dailyAt('18:00'); // Envia diariamente às 18:00
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
