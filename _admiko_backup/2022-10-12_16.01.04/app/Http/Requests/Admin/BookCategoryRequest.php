<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Response;

class BookCategoryRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->route("book_category") ?? null;
		return [
            "category_name"=>[
				"string",
				"unique:book_category,category_name,".$id.",id,deleted_at,NULL",
				"required"
			],
			"description"=>[
				"string",
				"unique:book_category,description,".$id.",id,deleted_at,NULL",
				"required"
			]
        ];
    }
    public function attributes()
    {
        return [
            "category_name"=>"Category Name",
			"description"=>"Description"
        ];
    }
    
    public function authorize()
    {
        if (!auth("admin")->check()) {
            return false;
        }
        return true;
    }
}