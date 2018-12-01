<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryDestroyRequest extends FormRequest
{
    /**
     * The route to redirect to if validation fails.
     *
     * @var string
     * 
     * DOES NOT WORK SOMEHOW
     */
    protected $redirectRoute = 'categories.index';
    /** For some reason not working */
    //protected $redirectRoute = "categories.index";

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Forbiding access to destroy route for default category Uncategorized
        return !($this->route('category')->id == config('cms.default_category_id'));
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
