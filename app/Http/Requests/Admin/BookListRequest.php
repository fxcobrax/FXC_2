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

class BookListRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->route("book_list") ?? null;
		return [
            "book_name"=>[
				"string",
				"unique:book_list,book_name,".$id.",id,deleted_at,NULL",
				"required"
			],
			"type"=>[
				"required"
			],
			"author"=>[
				"string",
				"nullable"
			],
			"rank_id"=>[
				"string",
				"nullable"
			],
			"description"=>[
				"string",
				"nullable"
			]
        ];
    }
    public function attributes()
    {
        return [
            "book_name"=>"Book Name",
			"type"=>"Type",
			"author"=>"Author",
			"rank_id"=>"Rank ID",
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