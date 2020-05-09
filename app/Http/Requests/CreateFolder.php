<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFolder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      // リクエストの内容に基づいた権限チェックをしてくれるが今回は使用しないのでtrue
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      //返却する配列にルールをつける
        return [
          'title' => 'required|max:20',
        ];
    }

    public function attributes()
    {
      return [
        'title' => 'フォルダ名',
      ];
    }
}
