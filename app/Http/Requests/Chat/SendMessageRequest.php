<?php

namespace App\Http\Requests\Chat;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare inputs for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('message') && is_string($this->input('message'))) {
            $this->merge([
                'message' => trim($this->input('message')),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $maxLength = (int) config('chat.message_max_length', 2000);

        return [
            'message' => [
                'required_without_all:attachments,attachment,file',
                'nullable',
                'string',
                "max:{$maxLength}",
            ],
            'attachments' => [
                'nullable',
                'array',
                'max:5',
            ],
            'attachments.*' => [
                'file',
            ],
        ];
    }

    /**
     * Custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'message.required' => 'Nội dung tin nhắn không được để trống.',
            'message.string' => 'Nội dung tin nhắn phải là chuỗi ký tự.',
            'message.min' => 'Nội dung tin nhắn phải có ít nhất 1 ký tự.',
            'message.max' => 'Nội dung tin nhắn không được vượt quá số ký tự cho phép.',
        ];
    }
}
