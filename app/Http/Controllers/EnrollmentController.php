<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Trainee;
use App\Models\TradeCourse;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Requests\UpdateEnrollmentRequest;
use App\Services\TradeSchoolService;

class EnrollmentController extends Controller
{
    protected $service;

    public function __construct(TradeSchoolService $service)
    {
        $this->service = $service;
    }

    // Display all enrollments
    public function index()
    {
        $enrollments = Enrollment::with([
            'trainee',
            'tradeCourse',
            'certification'
        ])->paginate(10);

        return view(
            'enrollments.index',
            compact('enrollments')
        );
    }

    // Display enrollment creation form
    public function create()
    {
        $trainees = Trainee::all();

        $courses = TradeCourse::all();

        return view(
            'enrollments.create',
            compact('trainees', 'courses')
        );
    }

    // Store new enrollment
    public function store(StoreEnrollmentRequest $request)
    {
        $this->service->createEnrollment(
            $request->validated()
        );

        return redirect()
            ->route('enrollments.index')
            ->with(
                'success',
                'Enrollment created successfully!'
            );
    }

    // Update existing enrollment
    public function update(
        UpdateEnrollmentRequest $request,
        $id
    ) {
        $this->service->updateEnrollment(
            $id,
            $request->validated()
        );

        return redirect()
            ->route('enrollments.index')
            ->with(
                'success',
                'Enrollment updated successfully!'
            );
    }
}
