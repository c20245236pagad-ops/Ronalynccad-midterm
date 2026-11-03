<?php

namespace App\Services;

use App\Models\TradeCourse;
use Illuminate\Support\Facades\DB;

class TradeCourseService
{
    private function cleanData(array $data): array
    {
        if (isset($data['course_name'])) {
            $data['course_name'] = trim(strip_tags($data['course_name']));
        }

        return $data;
    }

    // Create a new trade course
    public function createCourse(array $data): TradeCourse
    {
        return DB::transaction(function () use ($data) {

            $data = $this->cleanData($data);

            return TradeCourse::create($data);
        });
    }

    // Update an existing trade course
    public function updateCourse(array $data, int $id): TradeCourse
    {
        return DB::transaction(function () use ($data, $id) {

            $course = TradeCourse::findOrFail($id);

            $data = $this->cleanData($data);

            $course->update($data);

            return $course->load('instructor');
        });
    }

    // Display all trade courses
    public function getAllCourses()
    {
        return TradeCourse::with('instructor')
            ->latest()
            ->paginate(10);
    }
}