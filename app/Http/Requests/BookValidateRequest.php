<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class BookValidateRequest extends FormRequest
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
        $id = $this->route('book');
        return [
            'title' => [
                'required',
                'max:10',
                Rule::unique('books')->ignore($id)
            ],
            'author'=>'required',
            'content'=>'required',
            'desc' => 'required|between:3,255',
            'cover' => 'sometimes|image'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '图书名称不能为空',
            'title.max' => '图书名称最多10位字符',
            'title.unique' => '图书为 :input 的名称已经存在 请更换',
            'desc.required' => '描述不能为空',
            'author.required' => '作者名称不能为空',
            'cover.required' => '请上传您的图书封面',
        ];
    }
}
