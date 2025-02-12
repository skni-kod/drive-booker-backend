<?php

namespace App\Http\Controllers;

use App\Http\Resources\DriverResource;
use Illuminate\Http\Request;

class InstructorDriverController extends Controller
{
    /**
     * Display a listing of the instructor's drivers.
     */
    public function index(Request $request)
    {
        $instructor = $request->user();
        $drivers = $instructor->drivers()->get();

        return DriverResource::collection($drivers);
    }
}
