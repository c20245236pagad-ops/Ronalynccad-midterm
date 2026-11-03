<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Http\Requests\StoreInstructorRequest;
use App\Http\Requests\UpdateInstructorRequest;
use App\Services\TradeSchoolService;

class InstructorController extends Controller
{
    protected $service;

    public function __construct(TradeSchoolService $service)
    {
        $this->service = $service;
    }

    // Display all instructors
    public function index()
    {
        $instructors = Instructor::with('tradeCourses')
            ->paginate(10);

        return view(
            'instructors.index',
            compact('instructors')
        );
    }

    // Show create form
    public function create()
    {
        return view('instructors.create');
    }

    // Store instructor
    public function store(StoreInstructorRequest $request)
    {
        $this->service->createInstructor(
            $request->validated()
        );

        return redirect()
            ->route('instructors.index')
            ->with('success', 'Instructor created successfully!');
    }

    // Update instructor
    public function update(
        UpdateInstructorRequest $request,
        $id
    ) {
        $this->service->updateInstructor(
            $id,
            $request->validated()
        );

        return redirect()
            ->route('instructors.index')
            ->with('success', 'Instructor updated successfully!');
    }
}
