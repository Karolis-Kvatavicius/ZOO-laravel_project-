<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimalRequest extends FormRequest
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

    protected function prepareForValidation()
{
    if ($this->has('animal_book'))
        $this->merge(['animal_book' => strip_tags($this->animal_book)]);
}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'birth_year' => ['required', 'regex:/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/'],
            'animal_book' => ['required', 'regex:/^[A-Za-z0-9\s.,]+$/'],
        ];
    }

}
