<?php

namespace App\Actions\Dashboard;

use App\Models\Customer;
use App\Models\Invoice;

class ListDashboardData
{
    protected $modules = ['Customer', 'Invoice']; // Add module names here

    public function handle(array $modules)
    {
        $data = [];

        foreach ($modules as $module) {
            $className = '\\App\\Actions\\Dashboard\\List' . $module;

            if (class_exists($className)) {
                $action = new $className();
                $data[strtolower($module) . 's'] = $action->handle();
            }
        }

        return $data;
    }
    
}
