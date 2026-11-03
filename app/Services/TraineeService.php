
<?php

namespace App\Services;

use App\Models\Trainee;
use Illuminate\Support\Facades\DB;

class TraineeService
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

    public function createTrainee(array $data): Trainee
    {
        return DB::transaction(function () use ($data) {
            return Trainee::create($this->cleanData($data));
        });
    }

    public function updateTrainee($id, array $data): Trainee
    {
        return DB::transaction(function () use ($id, $data) {
            $trainee = Trainee::findOrFail($id);
            $trainee->update($this->cleanData($data));

            return $trainee;
        });
    }

    public function getAllTrainees()
    {
        return Trainee::with('enrollments')->latest()->paginate(10);
    }

    public function getTrainee($id): Trainee
    {
        return Trainee::with('enrollments')->findOrFail($id);
    }

    public function deleteTrainee($id): bool
    {
        return DB::transaction(function () use ($id) {
            return Trainee::findOrFail($id)->delete();
        });
    }
}
