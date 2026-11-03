<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\Enrollment;
use App\Http\Requests\StoreCertificationRequest;
use App\Http\Requests\UpdateCertificationRequest;
use App\Services\TradeSchoolService;

class CertificationController extends Controller
{
    protected $service;

    public function __construct(TradeSchoolService $service)
    {
        $this->service = $service;
    }

    // Display all certifications
    public function index()
    {
        $certifications = Certification::with([
            'enrollment.trainee',
            'enrollment.tradeCourse'
        ])->paginate(10);

        return view(
            'certifications.index',
            compact('certifications')
        );
    }

    // Show create form
    public function create()
    {
        $enrollments = Enrollment::with([
            'trainee',
            'tradeCourse'
        ])->get();

        return view(
            'certifications.create',
            compact('enrollments')
        );
    }

    // Store certification
    public function store(StoreCertificationRequest $request)
    {
        $this->service->createCertification(
            $request->validated()
        );

        return redirect()
            ->route('certifications.index')
            ->with('success', 'Certification processed successfully!');
    }

    // Update certification
    public function update(
        UpdateCertificationRequest $request,
        $id
    ) {
        $this->service->updateCertification(
            $id,
            $request->validated()
        );

        return redirect()
            ->route('certifications.index')
            ->with('success', 'Certification updated successfully!');
    }
}
