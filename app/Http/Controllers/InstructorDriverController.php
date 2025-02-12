<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\DriverResource;

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
