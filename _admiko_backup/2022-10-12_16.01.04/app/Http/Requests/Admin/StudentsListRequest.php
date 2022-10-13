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

class StudentsListRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->route("students_list") ?? null;
		return [
            "first_name"=>[
				"string",
				"required"
			],
			"gender"=>[
				"nullable"
			],
			"date_of_birth"=>[
				'date_format:"'.config('admiko_config.table_date_time_format').'"',
				"required"
			],
			"national_id"=>[
				"string",
				"required"
			],
			"email"=>[
				"email",
				"unique:students_list,email,".$id.",id,deleted_at,NULL",
				"required"
			],
			"phone_number"=>[
				"integer",
				"required"
			],
			"student_picture"=>[
				"image",
				"max:10280",
				"file_extension:jpg,png,jpeg",
				"mimes:jpg,png,jpeg",
				"nullable"
			],
			"residential_address"=>[
				"string",
				"required"
			],
			"digital_address"=>[
				"string",
				"nullable"
			],
			"popular_landmark"=>[
				"string",
				"nullable"
			],
			"fullname"=>[
				"string",
				"required"
			],
			"occupation"=>[
				"string",
				"nullable"
			],
			"address"=>[
				"string",
				"required"
			],
			"phone_number1"=>[
				"string",
				"unique:students_list,phone_number1,".$id.",id,deleted_at,NULL",
				"required"
			],
			"select_class"=>[
				"required"
			],
			"select_department"=>[
				"nullable"
			],
			"select_club"=>[
				"nullable"
			],
			"dormitory_name"=>[
				"nullable"
			],
			"select_route"=>[
				"nullable"
			]
        ];
    }
    public function attributes()
    {
        return [
            "first_name"=>"Full Name",
			"gender"=>"Gender",
			"date_of_birth"=>"Date Of Birth",
			"national_id"=>"National ID",
			"email"=>"Email",
			"phone_number"=>"Phone Number",
			"student_picture"=>"Student Picture",
			"residential_address"=>"Residential Address",
			"digital_address"=>"Digital Address",
			"popular_landmark"=>"Popular Landmark",
			"fullname"=>"Full Name",
			"occupation"=>"Occupation",
			"address"=>"Address",
			"phone_number1"=>"Phone Number",
			"select_class"=>"Select Class",
			"select_department"=>"Select Department",
			"select_club"=>"Select Club",
			"dormitory_name"=>"Dormitory Name",
			"select_route"=>"Select Route"
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