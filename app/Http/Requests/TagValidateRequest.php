<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagValidateRequest extends FormRequest
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
        $id = $this->route('tag');
        return [
            'tag_name' => [
                'required',
                'max:3',
                Rule::unique('tags')->ignore($id)
            ],
            'desc' => 'required|between:2,255',
        ];
    }
    public function messages()
    {
        return [
            'tag_name.required' => '标签名称不能为空',
            'tag_name.max' => '标签名称最多3位字符',
            'tag_name.unique' => '标签为 :input 的名称已经存在 请更换',
            'desc.required' => '描述不能为空',
            'desc.between' => '必须介于 2 - 255 个字符之间',
        ];
    }
}
