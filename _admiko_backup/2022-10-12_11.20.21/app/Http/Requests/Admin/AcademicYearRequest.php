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

class AcademicYearRequest extends FormRequest
{
    public function rules()
    {
        return [
            "year_name"=>[
				"string",
				"nullable"
			],
			"start_date"=>[
				'date_format:"'.config('admiko_config.table_date_time_format').'"',
				"nullable"
			],
			"end_date"=>[
				'date_format:"'.config('admiko_config.table_date_time_format').'"',
				"nullable"
			]
        ];
    }
    public function attributes()
    {
        return [
            "year_name"=>"Year Name",
			"start_date"=>"Start Date",
			"end_date"=>"End Date"
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