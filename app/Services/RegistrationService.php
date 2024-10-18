<?php

namespace App\Services;

use App\Repositories\RegistrationRepository;

class RegistrationService
{
    protected $registrationRepository;

    public function __construct(RegistrationRepository $registrationRepository)
    {
        $this->registrationRepository = $registrationRepository;
    }

    public function getAllRegistrations()
    {
        return $this->registrationRepository->all();
    }

    public function createRegistration(array $data)
    {
        return $this->registrationRepository->create($data);
    }

    public function find($id)
    {
        return $this->registrationRepository->find($id);
    }

    public function updateRegistration($id, array $data)
    {
        return $this->registrationRepository->update($id, $data);
    }

    public function deleteRegistration($id)
    {
        return $this->registrationRepository->delete($id);
    }
}
