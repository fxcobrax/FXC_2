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

class DormsRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->route("dorms") ?? null;
		return [
            "dorm_name"=>[
				"string",
				"unique:dorms,dorm_name,".$id.",id,deleted_at,NULL",
				"required"
			],
			"dorm_type"=>[
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
            "dorm_name"=>"Dorm Name",
			"dorm_type"=>"Dorm Type",
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