<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScoreRequest extends FormRequest
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
            'title' => 'required|string|min:2|max:25',
            'review' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'comment' => 'required|min:25|max:500',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルを入力して下さい',
            'title.max' => 'タイトルは25文字以下で入力して下さい',
            'title.min' => 'タイトルは2文字以上で入力して下さい',
            'title.string' => 'タイトルは文字列で入力して下さい',
            'review.required' => '評価を選択して下さい',
            'age.required' => '年代を選択して下さい',
            'gender.required' => '性別を選択して下さい',
            'comment.required' => '本文を入力して下さい',
            'comment.min' => '本文は25文字以上で入力して下さい',
            'comment.max' => '本文は500文字以下で入力して下さい',
        ];
    }
}
