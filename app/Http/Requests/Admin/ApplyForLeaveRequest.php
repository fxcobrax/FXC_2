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

class ApplyForLeaveRequest extends FormRequest
{
    public function rules()
    {
        return [
            "staff_name"=>[
				"required"
			],
			"leave_type"=>[
				"required"
			],
			"from"=>[
				'date_format:"'.config('admiko_config.table_date_time_format').'"',
				"required"
			],
			"to"=>[
				'date_format:"'.config('admiko_config.table_date_time_format').'"',
				"required"
			],
			"reason"=>[
				"required"
			]
        ];
    }
    public function attributes()
    {
        return [
            "staff_name"=>"Staff Name",
			"leave_type"=>"Leave Type",
			"from"=>"From",
			"to"=>"To",
			"reason"=>"Reason"
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