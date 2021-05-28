<?php

namespace App\Http\Requests\Admin\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
        // return $this->user()->can('create');
    }

    public function rules()
    {
        return [
            'first_name'    => 'required|max:191',
            'last_name'     => 'nullable|max:191',
            'email'         => 'required|email',
            'avatar'        => 'nullable|mimes:png,jpg,jpeg|max:5120',
            'status'        => 'required|in:'.implode(',', User::STATUSES),
            'password'      => 'required|min:8|max:191',
            'confirm_password'  => 'required|min:8|max:191|same:password',
            'group_ids'     => 'nullable|array'
        ];
    }

    public function hasGroupIds()
    {
        return $this->group_ids && count($this->group_ids);
    }
}
