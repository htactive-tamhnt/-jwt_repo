<?php
 
namespace App\Http\Requests;
 
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
 
class RegisterAuthRequest extends FormRequest
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
            'name' => 'bail|required|min:3|max:255|regex:/[a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ ]+$/',
            'email' => 'bail|required|email|unique:users|max:255',
            'password' => 'bail|required|min:6|max:255|confirmed',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'your fullname',
            'email' => 'your email',
            'password' => 'your password',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'The :attribute field is not empty',
            'email' => 'The :attribute field is incorrect',
            'max' => 'The :attribute field contains up to 255 characters',
            'unique' => 'The :attribute already exits in your database',
            'name.min' => 'The your fullname field contains at least 3 characters',
            'password.min' => 'The your password field contains at least 6 characters',
        ];
    }
}