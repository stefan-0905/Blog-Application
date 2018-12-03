<?php

namespace App\Http\Requests;

use App\Exceptions\DefaultCategoryException;
use Illuminate\Foundation\Http\FormRequest;

class CategoryDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /**
         * Forbiding access to destroy route for default category Uncategorized
         * Throwing exception if the category ID matches default category id from our config file
         * Else return true and authorize action
         */
        if($this->route('category')->id == config('cms.default_category_id')) 
            throw new DefaultCategoryException();
        
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
