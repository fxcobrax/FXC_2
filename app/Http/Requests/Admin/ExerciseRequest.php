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

class ExerciseRequest extends FormRequest
{
    public function rules()
    {
        return [
            "exercise_name"=>[
				"string",
				"required"
			],
			"class"=>[
				"required"
			],
			"subject"=>[
				"required"
			],
			"marks"=>[
				"integer",
				"required",
				"min:1"
			],
			"date"=>[
				'date_format:"'.config('admiko_config.table_date_time_format').'"',
				"required"
			]
        ];
    }
    public function attributes()
    {
        return [
            "exercise_name"=>"Exercise Name",
			"class"=>"Class",
			"subject"=>"Subject",
			"marks"=>"Marks",
			"date"=>"Date"
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