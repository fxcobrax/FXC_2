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

class LeaveTypeRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->route("leave_type") ?? null;
		return [
            "type_name"=>[
				"string",
				"unique:leave_type,type_name,".$id.",id,deleted_at,NULL",
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
            "type_name"=>"Type Name",
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