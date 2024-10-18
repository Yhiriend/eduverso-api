<?php

namespace App\Repositories;

use App\Models\RegistrationModel;

class RegistrationRepository
{
    public function all()
    {
        return RegistrationModel::all();
    }

    public function create(array $data)
    {
        return RegistrationModel::create($data);
    }

    public function find($id)
    {
        return RegistrationModel::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $registration = $this->find($id);
        $registration->update($data);
        return $registration;
    }

    public function delete($id)
    {
        $registration = $this->find($id);
        return $registration->delete();
    }
}
