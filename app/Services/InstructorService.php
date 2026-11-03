
<?php

namespace App\Services;

use App\Models\Instructor;
use Illuminate\Support\Facades\DB;

class InstructorService
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

    public function createInstructor(array $data): Instructor
    {
        return DB::transaction(function () use ($data) {
            return Instructor::create($this->cleanData($data));
        });
    }

    public function updateInstructor($id, array $data): Instructor
    {
        return DB::transaction(function () use ($id, $data) {
            $instructor = Instructor::findOrFail($id);
            $instructor->update($this->cleanData($data));

            return $instructor;
        });
    }

    public function getAllInstructors()
    {
        return Instructor::latest()->paginate(10);
    }

    public function getInstructor($id): Instructor
    {
        return Instructor::findOrFail($id);
    }

    public function deleteInstructor($id): bool
    {
        return DB::transaction(function () use ($id) {
            return Instructor::findOrFail($id)->delete();
        });
    }
}
