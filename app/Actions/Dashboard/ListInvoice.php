<?php

namespace App\Actions\Dashboard;

use App\Models\Invoice;

class ListInvoice
{
    public function handle()
    {
        return Invoice::all();
    }
}
