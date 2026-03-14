<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;

class UpdatePendingOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:update-pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update PENDING orders to PROCESSING';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
          Order::where('status', 'PENDING')->update(['status' => 'PROCESSING']);
          $this->info('Pending orders updated to PROCESSING');
    }
}
