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

class ItemsListRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->route("items_list") ?? null;
		return [
            "item_name"=>[
				"string",
				"unique:items_list,item_name,".$id.",id,deleted_at,NULL",
				"required"
			],
			"type"=>[
				"required"
			],
			"quantity"=>[
				"integer",
				"required",
				"min:1"
			],
			"price"=>[
				"numeric",
				"required",
				"min:0"
			],
			"supplier"=>[
				"nullable"
			]
        ];
    }
    public function attributes()
    {
        return [
            "item_name"=>"Item Name",
			"type"=>"Type",
			"quantity"=>"Quantity",
			"price"=>"Price/unit",
			"supplier"=>"Supplier"
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