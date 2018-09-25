<?php

namespace App\Http\Controllers;

use App\Http\Services\Appointment\IndexService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(IndexService $indexService)
    {
        return $indexService->indexAction();
    }
}
