<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
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
            'title' => 'required',
            'content' => 'required',
            'resources_required' => 'required',
            'area' => 'required',
            'qualification' => 'required',
            'file' => 'file|mimes:jpg,jpeg,png,gif|max:1048'
        ];
    }

    public function message() {
        return [
            'title.required' => 'タイトルがみ入力です',
            'content.required'  => '内容がみ入力です',
            'resource_required' => '応募条件が未入力です',
            'area.required' => 'エリアがみ入力です',
            'qualification.required' => '応募資格がみ入力です',
            'file.required' => '投稿画像がみ入力です'
        ];
    }
}
