<?php

namespace App\Actions\Fortify;

use App\Models\Resident;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',

            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'date_of_birth' => ['required'],
            'contact_number' => ['required', 'string', 'max:11']
        ])->validate();

        $role_id = null;
        $role = Role::where('name', 'Resident')->first();
        if ($role) {
            $role_id = $role->id;
        }

        $user = User::create([
            // 'name' => $input['name'],
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role_id' => $role_id,
        ]);

        $resident = Resident::create([
            'user_id' => $user->id,
            'uuid' => Hash::make($user->id),
            'first_name' => $input['first_name'],
            'middle_name' => $input['middle_name'],
            'last_name' => $input['last_name'],
            'gender' => $input['gender'],
            'date_of_birth' => date("Y-m-d", strtotime($input['date_of_birth'])),
            'contact_number' => $input['contact_number'],
            'barangay_id' => $input['barangay_id'],
            'address' => $input['address'],
            'status' => 'FOR_REVIEW'
        ]);

        if ($input['psa'] !== null) {
            $this->uploadFile($resident->id, "PSA", $input['psa']);
        }

        if ($input['valid_id'] !== null) {
            $this->uploadFile($resident->id, "VALID_ID", $input['valid_id']);
        }

        return $user;
    }

    public function uploadFile($resident_id, $documentType, $file) {
        $cFile = curl_file_create($file);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/api/residents/" . $resident_id . "/documents");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            'document_type' => $documentType,
            'file' => $cFile
        ));

        curl_exec($ch);
        curl_close($ch);
    }
}
