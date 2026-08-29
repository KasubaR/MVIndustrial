<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:180'],
            'phone' => ['nullable', 'string', 'max:40'],
            'company' => ['nullable', 'string', 'max:150'],
            'topic' => ['required', Rule::in(config('company.enquiry_topics'))],
            'message' => ['required', 'string', 'min:20', 'max:4000'],
            // Bots fill hidden fields; humans leave this empty.
            'website' => ['prohibited'],
        ];
    }

    public function messages(): array
    {
        return [
            'message.min' => 'Please give us a little more detail so we can quote accurately.',
            'topic.in' => 'Please choose one of the listed services.',
            'website.prohibited' => 'Your submission could not be processed.',
        ];
    }

    public function attributes(): array
    {
        return [
            'topic' => 'service',
            'company' => 'company name',
        ];
    }
}
