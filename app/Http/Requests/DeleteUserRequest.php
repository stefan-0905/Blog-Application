<?php

namespace App\Http\Requests;

use App\Exceptions\DefaultUserException;
use Illuminate\Foundation\Http\FormRequest;

class DeleteUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /**
         * Forbiding access to destroy route for default user and currently authenticated user
         * Throwing exception if one of these happens
         * Else authorize action
         */
        if($this->route('user') == config('cms.default_category_id') ||
                    $this->route('user') == auth()->user()->id)
            throw new DefaultUserException();

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
