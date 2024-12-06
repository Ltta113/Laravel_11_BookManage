<?php

namespace App\Console\Commands;

use App\Mail\InventoryNotification;
use Illuminate\Console\Command;

class SendInventoryNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inventory:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gửi thông báo số lượng sản phẩm trong kho cho admin';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        \Mail::to('admin@example.com')->send(new InventoryNotification());
        $this->info('Thông báo số lượng sản phẩm đã được gửi cho admin.');
    }
}
