<?php

namespace App\Http\Repositories;

use App\Http\Requests\Api\StoreAppointmentRequest;
use Illuminate\Http\Request;

interface AppointmentInterface
{
    /**
     * Display a listing of the resource.
     *
     * @param $userId
     * @return \Illuminate\Http\Response
     */
    public function index($userId);

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    public function store($data);

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id);

    /**
     * Update the specified resource in storage.
     *
     * @param array $data
     * @param $userId
     * @return \Illuminate\Http\Response
     */
    public function update($data, $userId);

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param $userId
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $userId);
}
