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

class MarkExerciseRequest extends FormRequest
{
    public function rules()
    {
        return [
            "student_name"=>[
				"nullable"
			],
			"exercise_name"=>[
				"nullable"
			],
			"marks"=>[
				"integer",
				"nullable"
			],
			"date"=>[
				'date_format:"'.config('admiko_config.table_date_time_format').'"',
				"nullable"
			]
        ];
    }
    public function attributes()
    {
        return [
            "student_name"=>"Student Name",
			"exercise_name"=>"Exercise Name",
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