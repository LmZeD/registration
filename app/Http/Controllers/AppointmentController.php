<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreAppointmentRequest;
use App\Http\Requests\Api\UpdateAppointmentRequest;
use App\Http\Requests\IdRequest;
use App\Http\Services\Appointment\DestroyService;
use App\Http\Services\Appointment\IndexService;
use App\Http\Services\Appointment\ShowService;
use App\Http\Services\Appointment\StoreService;
use App\Http\Services\Appointment\UpdateService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(IndexService $indexService)
    {
        return $indexService->indexAction();
    }

    public function store(StoreAppointmentRequest $request, StoreService $storeService)
    {
        return $storeService->storeAction($request->toArray());
    }

    public function show(Request $request, ShowService $showService)
    {
        return $showService->showAction($request->id);
    }

    public function update(UpdateAppointmentRequest $request, UpdateService $updateService)
    {
        return $updateService->updateAction($request->toArray());
    }

    public function destroy(IdRequest $request, DestroyService $destroyService)
    {
        return $destroyService->destroyAction($request->id);
    }
}
