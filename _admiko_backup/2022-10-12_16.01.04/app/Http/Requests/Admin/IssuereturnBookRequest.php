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

class IssuereturnBookRequest extends FormRequest
{
    public function rules()
    {
        return [
            "book_name"=>[
				"required"
			],
			"student_name"=>[
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
			"status"=>[
				"required"
			]
        ];
    }
    public function attributes()
    {
        return [
            "book_name"=>"Book Name",
			"student_name"=>"Student Name",
			"from"=>"From",
			"to"=>"To",
			"status"=>"Status"
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