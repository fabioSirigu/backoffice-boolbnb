<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateHomeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                Rule::unique('homes')->ignore($this->home->id),
            ],
            'slug' => 'required|max:255',
            'rooms' => 'required|min:1',
            'beds' => 'required|max:1|max:25',
            'bathrooms' => 'required|max:1|max:255',
            'address' => 'required|min:5|max:255',
            'latitude' => 'required|nullable|min:5|max:100',
            'longitude' => 'required|nullable|min:5|max:100',
            'cover_image' => 'required|image|max:300',
            'visible' => 'required|boolean'
        ];
    }
}
