<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Services\DemoService;
use App\Services\ResetService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class ResetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ns:reset {--mode=soft}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will wipe the database and force reinstallation. Cannot be undone.';

    /**
     * Reset service
     */
    private ResetService $resetService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        ResetService $resetService
    ) {
        parent::__construct();

        $this->resetService = $resetService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        switch ( $this->option( 'mode' ) ) {
            case 'soft':
                return $this->softReset();
                break;
            case 'hard':
                return $this->hardReset();
                break;
            default:
                $this->error( __( 'Unsupported reset mode.' ) );
                break;
        }
    }

    /**
     * Proceed hard reset
     */
    private function hardReset(): void
    {
        $result = $this->resetService->hardReset();

        $this->info( $result[ 'message' ] );
    }

    /**
     * Proceed soft reset
     */
    private function softReset(): void
    {
        $result = $this->resetService->softReset();

        $this->info( $result[ 'message' ] );
    }
}
