<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|string|max:191',
            'password' => 'required|min:8|max:191|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'メールアドレスを入力して下さい。',
            'email.email' => 'メールアドレスの形式で入力して下さい。',
            'email.string' => 'メールアドレスは文字列で入力して下さい。',
            'email.max' => 'メールアドレスは191文字以下で入力して下さい。',
            'password.required' => 'パスワードを入力して下さい。',
            'password.min' => 'パスワードは8文字以上で入力して下さい。',
            'password.max' => 'パスワードは191文字以下で入力して下さい。',
            'password.min' => 'パスワードは8文字以上で入力して下さい。',
            'password.regex' => 'パスワードは半角英数字の組み合わせで入力して下さい。',
        ];
    }
}
