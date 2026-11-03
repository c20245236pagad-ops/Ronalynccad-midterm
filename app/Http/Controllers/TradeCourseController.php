<?php

namespace App\Http\Controllers;

use App\Models\TradeCourse;
use App\Models\Instructor;
use App\Http\Requests\StoreTradeCourseRequest;
use App\Http\Requests\UpdateTradeCourseRequest;
use App\Services\TradeSchoolService;

class TradeCourseController extends Controller
{
    protected $service;

    public function __construct(TradeSchoolService $service)
    {
        $this->service = $service;
    }

    // Display all trade courses
    public function index()
    {
        $courses = TradeCourse::with([
            'instructor',
            'enrollments.trainee'
        ])->paginate(10);

        return view('trade_courses.index', compact('courses'));
    }

    // Show create form
    public function create()
    {
        $instructors = Instructor::all();

        return view(
            'trade_courses.create',
            compact('instructors')
        );
    }

    // Store a new trade course
    public function store(StoreTradeCourseRequest $request)
    {
        $this->service->createTradeCourse(
            $request->validated()
        );

        return redirect()
            ->route('trade-courses.index')
            ->with('success', 'Trade course created successfully!');
    }

    // Update an existing trade course
    public function update(
        UpdateTradeCourseRequest $request,
        $id
    ) {
        $this->service->updateTradeCourse(
            $id,
            $request->validated()
        );

        return redirect()
            ->route('trade-courses.index')
            ->with('success', 'Trade course updated successfully!');
    }
}
