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

class SuppliersRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->route("suppliers") ?? null;
		return [
            "supplier_name"=>[
				"string",
				"unique:suppliers,supplier_name,".$id.",id,deleted_at,NULL",
				"required"
			],
			"company"=>[
				"string",
				"required"
			],
			"address"=>[
				"string",
				"required"
			],
			"phone_number"=>[
				"integer",
				"required"
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
            "supplier_name"=>"Supplier Name",
			"company"=>"Company",
			"address"=>"Address",
			"phone_number"=>"Phone Number",
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