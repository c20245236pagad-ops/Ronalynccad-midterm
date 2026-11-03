
<?php

namespace App\Services;

use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;

class EnrollmentService
{
    private function cleanData(array $data): array
    {
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $data[$key] = trim(strip_tags($value));
            }
        }

        return $data;
    }

    public function createEnrollment(array $data): Enrollment
    {
        return DB::transaction(function () use ($data) {
            return Enrollment::create($this->cleanData($data));
        });
    }

    public function updateEnrollment($id, array $data): Enrollment
    {
        return DB::transaction(function () use ($id, $data) {
            $enrollment = Enrollment::findOrFail($id);
            $enrollment->update($this->cleanData($data));

            return $enrollment;
        });
    }

    public function getAllEnrollments()
    {
        return Enrollment::with(['trainee', 'tradeCourse'])
            ->latest()
            ->paginate(10);
    }

    public function getEnrollment($id): Enrollment
    {
        return Enrollment::with(['trainee', 'tradeCourse'])
            ->findOrFail($id);
    }

    public function deleteEnrollment($id): bool
    {
        return DB::transaction(function () use ($id) {
            return Enrollment::findOrFail($id)->delete();
        });
    }
}
