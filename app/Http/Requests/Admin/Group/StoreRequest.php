<?php

namespace App\Http\Requests\Admin\Group;

use App\Model\Group;
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
            'name'      => 'required|unique:groups,name',
            'active'    => 'nullable|boolean',
            'user_ids'  => 'nullable|array',
            'permission_ids'    => 'nullable|array'
        ];
    }
}
