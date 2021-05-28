<?php

namespace App\Http\Requests\Admin\Group;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
        // return $this->user()->can('update');
    }

    public function rules()
    {
        return [
            'name'      => 'required|unique:groups,name,'.$this->group->id,
            'active'    => 'nullable|boolean',
            'user_ids'  => 'nullable|array',
            'permission_ids'    => 'nullable|array'
        ];
    }
}
