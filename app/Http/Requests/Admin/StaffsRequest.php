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

class StaffsRequest extends FormRequest
{
    public function rules()
    {
        return [
            "role"=>[
				"required"
			],
			"full_name"=>[
				"string",
				"required"
			],
			"gender"=>[
				"required"
			],
			"date_of_birth"=>[
				'date_format:"'.config('admiko_config.table_date_time_format').'"',
				"required"
			],
			"address"=>[
				"string",
				"nullable"
			],
			"picture"=>[
				"image",
				"file_extension:jpg,png,jpeg",
				"mimes:jpg,png,jpeg",
				"nullable"
			],
			"phone_number"=>[
				"integer",
				"nullable"
			],
			"email"=>[
				"email",
				"nullable"
			],
			"document"=>[
				"file",
				"nullable"
			],
			"contract_type"=>[
				"nullable"
			],
			"salary"=>[
				"numeric",
				"min:1",
				"nullable"
			]
        ];
    }
    public function attributes()
    {
        return [
            "role"=>"Role",
			"full_name"=>"Full Name",
			"gender"=>"Gender",
			"date_of_birth"=>"Date Of Birth",
			"address"=>"Address",
			"picture"=>"Picture",
			"phone_number"=>"Phone Number",
			"email"=>"Email",
			"document"=>"Document",
			"contract_type"=>"Contract Type",
			"salary"=>"Salary"
        ];
    }
    public function messages()
    {
        return [
            "document.required_without"=>trans("validation.required")
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