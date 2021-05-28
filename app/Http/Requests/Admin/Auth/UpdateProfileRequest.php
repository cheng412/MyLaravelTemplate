<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'first_name'    => 'required|max:191',
            'last_name'     => 'nullable|max:191',
            'email'         => 'required|email',
            'avatar'        => 'nullable|mimes:png,jpg,jpeg|max:5120',
        ];
    }
}
