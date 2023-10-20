<?php

namespace App\Http\Controllers;

use App\Crud\CloudPlanCrud;
use Illuminate\Http\Request;

class CloudPlanController extends Controller
{
    public function showCloudPlans()
    {
        return CloudPlanCrud::table();
    }

    public function createCloudPlans()
    {
        return CloudPlanCrud::form();
    }
}
