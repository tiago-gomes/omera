<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class CreateContact extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize()
        {
            return false; // to be determined
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {
            return [
                'firstName' => 'sometimes|string',
                'email' => 'sometimes|email',
                'phone' => 'sometimes|string',
                'leadSource' => 'sometimes|string',
                'salesforce_external_id' => 'sometimes|string'
            ];
        }
    }
