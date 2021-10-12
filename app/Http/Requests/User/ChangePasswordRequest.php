<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Hash;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'old_password' => ['required', function ($attribute, $value, $fail) {
               // $value1='$2y$10$rqG6J.r.aenCRlzr38eQ6eli1PRYLqmABAKwxU1Zje9rvPcKT9ulu';
                if (!\Hash::check($value,Auth::user()->password)) {
                   
                    return $fail(__('The Old password is incorrect.'));
                }
            }],
            'new_password' => 'required|required_with:confirm_password|same:confirm_password|min:6|max:255|different:old_password',
            'confirm_password' => 'required|min:6|max:255',
        ];
    }
}

