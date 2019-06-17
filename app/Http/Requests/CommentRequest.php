<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CommentRequest extends FormRequest
{
    // Fix lỗi trả về trang chủ
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'bail|required|min:3|max:255',
            'content' => 'bail|required|min:3|max:255'
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'tiêu đề',
            'content' => 'nội dung'
        ];
    }
    public function messages()
    {
        return [
            'required' => 'The :attribute field is not empty',
            'email' => 'The :attribute field is incorrect',
            'max' => 'The :attribute field contains up to 255 characters',
            'min' => 'The :attribute field contains at least 3 characters'
        ];
    }
}