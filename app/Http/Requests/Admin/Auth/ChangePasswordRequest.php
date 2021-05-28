<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'old_password'      => ['required', 
                function ($attribute, $value, $fail) {
                    if (!auth()->user()->isOldPassword($value))
                        $fail('Old password is invalid.');
                }
            ],
            'password'          => 'required|min:8|max:191',
            'confirm_password'  => 'required|min:8|max:191|same:password',
        ];
    }
}
