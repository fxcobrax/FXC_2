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

class FeeTypeRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->route("fee_type") ?? null;
		return [
            "type_name"=>[
				"string",
				"unique:fee_type,type_name,".$id.",id,deleted_at,NULL",
				"required"
			],
			"amount"=>[
				"numeric",
				"required",
				"min:1"
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
            "type_name"=>"Type Name",
			"amount"=>"Amount",
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