
<?php

namespace App\Services;

use App\Models\Certification;
use Illuminate\Support\Facades\DB;

class CertificationService
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

    public function createCertification(array $data): Certification
    {
        return DB::transaction(function () use ($data) {
            return Certification::create($this->cleanData($data));
        });
    }

    public function updateCertification($id, array $data): Certification
    {
        return DB::transaction(function () use ($id, $data) {
            $certification = Certification::findOrFail($id);
            $certification->update($this->cleanData($data));

            return $certification;
        });
    }

    public function getAllCertifications()
    {
        return Certification::with('enrollment')
            ->latest()
            ->paginate(10);
    }

    public function getCertification($id): Certification
    {
        return Certification::with('enrollment')
            ->findOrFail($id);
    }

    public function deleteCertification($id): bool
    {
        return DB::transaction(function () use ($id) {
            return Certification::findOrFail($id)->delete();
        });
    }
}
