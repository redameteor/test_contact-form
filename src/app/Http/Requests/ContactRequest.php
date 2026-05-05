<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'first_name'   => ['required', 'string', 'max:255'],
            'last_name'    => ['required', 'string', 'max:255'],
            'gender'       => ['required'],
            'email'        => ['required', 'string', 'email', 'max:255'],
            'tel'          => ['required'],
            'address'      => ['required', 'string', 'max:255'],
            'inquiry_type' => ['required'],
            'detail'       => ['required', 'string', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => '苗字を入力してください',
            'last_name.required'  => '名前を入力してください',
            'gender.required'     => '性別を選択してください',
            'email.required'      => 'メールアドレスを入力してください',
            'tel.required'        => '電話番号を入力してください',
            'tel.digits_between'  => '電話番号は10桁から11桁の間で入力してください',
            'address.required'    => '住所を入力してください',
            'inquiry_type.required' => 'お問い合わせの種類を選択してください',
            'detail.required'     => 'お問い合わせ内容を入力してください',
            'detail.max'          => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
