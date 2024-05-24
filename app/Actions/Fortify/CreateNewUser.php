<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Http\UploadedFile;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'business_name' => ['required', 'string', 'max:255'],
            'merchant_name' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'pick_up_location' => ['required', 'string', 'max:255'],
            'phone' => ['required'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'nid_front' => ['required'],
            'nid_back' => ['required'],
            'profile_img' => ['required', 'max:2048'],
        ])->validate();

        $user = User::create([
            'business_name' => $input['business_name'],
            'merchant_name' => $input['merchant_name'],
            'district' => $input['district'],
            'pick_up_location' => $input['pick_up_location'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'nid_front' => '',
            'nid_back' => '',
            'profile_img' => '',
        ]);

        $this->uploadFiles($user, $input);

        session()->flash('success', 'Registration successful! You can now login.');
        return $user;
    }

    private function uploadFiles(User $user, array $input): void
    {
        $destinationPath = 'merchant/nid-photos/';
        if (isset($input['nid_front']) && $input['nid_front'] instanceof UploadedFile) {
            $nid_frontName = $user->merchant_name . '_' . $input['nid_front']->getClientOriginalName();
            $input['nid_front']->move($destinationPath, $nid_frontName);
            $user->update(['nid_front' => $nid_frontName]);
        }
        if (isset($input['nid_back']) && $input['nid_back'] instanceof UploadedFile) {
            $nid_backName = $user->merchant_name . '_' . $input['nid_back']->getClientOriginalName();
            $input['nid_back']->move($destinationPath, $nid_backName);
            $user->update(['nid_back' => $nid_backName]);
        }
        $destinationPath = 'merchant/profile-photos/';
        if (isset($input['profile_img']) && $input['profile_img'] instanceof UploadedFile) {
            $profile_imgName = $user->merchant_name . '_' . $input['profile_img']->getClientOriginalName();
            $input['profile_img']->move($destinationPath, $profile_imgName);
            $user->update(['profile_img' => $profile_imgName]);
        }
    }
}
