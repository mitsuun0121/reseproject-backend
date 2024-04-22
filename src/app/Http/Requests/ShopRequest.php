<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'name' => 'required|max:50',
            'area_id' => 'required',
            'genre_id' => 'required',
            'description' => 'required|max:400',
            'photo_url' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '店名を入力して下さい。',
            'name.max' => '店名は50文字以下で入力して下さい。',
            'area_id.required' => '地域を選択して下さい。',
            'genre_id.required' => 'ジャンルを選択して下さい。',
            'description.required' => '店舗概要を入力して下さい。',
            'description.max' => '店舗概要は400文字以下で入力して下さい。',
            'photo_url.required' => '画像を選択して下さい。',
        ];
    }
}
