<?php

namespace App\Http\Controllers;

use App\Models\Trainee;
use App\Http\Requests\StoreTraineeRequest;
use App\Http\Requests\UpdateTraineeRequest;
use App\Services\TradeSchoolService;

class TraineeController extends Controller
{
    protected $service;

    public function __construct(TradeSchoolService $service)
    {
        $this->service = $service;
    }

    // Display all trainees
    public function index()
    {
        $trainees = Trainee::with([
            'enrollments.tradeCourse',
            'enrollments.certification'
        ])->paginate(10);

        return view(
            'trainees.index',
            compact('trainees')
        );
    }

    // Show create form
    public function create()
    {
        return view('trainees.create');
    }

    // Store trainee
    public function store(StoreTraineeRequest $request)
    {
        $this->service->createTrainee(
            $request->validated()
        );

        return redirect()
            ->route('trainees.index')
            ->with('success', 'Trainee created successfully!');
    }

    // Update trainee
    public function update(
        UpdateTraineeRequest $request,
        $id
    ) {
        $this->service->updateTrainee(
            $id,
            $request->validated()
        );

        return redirect()
            ->route('trainees.index')
            ->with('success', 'Trainee updated successfully!');
    }
}
