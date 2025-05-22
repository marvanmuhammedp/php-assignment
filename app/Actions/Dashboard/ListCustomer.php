<?php

namespace App\Actions\Dashboard;

use App\Models\Customer;

class ListCustomer
{
    public function handle()
    {
        return Customer::all();
    }
}
