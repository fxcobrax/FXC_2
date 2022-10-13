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

class FeePaymentRequest extends FormRequest
{
    public function rules()
    {
        return [
            "fee_type"=>[
				"required"
			],
			"student_name"=>[
				"required"
			],
			"amount"=>[
				"numeric",
				"min:1",
				"nullable"
			],
			"status"=>[
				"nullable"
			]
        ];
    }
    public function attributes()
    {
        return [
            "fee_type"=>"Fee Type",
			"student_name"=>"Student Name",
			"amount"=>"Amount",
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