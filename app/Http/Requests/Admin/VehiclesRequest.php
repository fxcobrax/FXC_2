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

class VehiclesRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->route("vehicles") ?? null;
		return [
            "vehicle_id"=>[
				"string",
				"unique:vehicles,vehicle_id,".$id.",id,deleted_at,NULL",
				"required"
			],
			"route"=>[
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
            "vehicle_id"=>"Vehicle ID",
			"route"=>"Route",
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