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

class PaySalaryRequest extends FormRequest
{
    public function rules()
    {
        return [
            "staff"=>[
				"required"
			],
			"amount"=>[
				"numeric",
				"required",
				"min:1"
			],
			"status"=>[
				"required"
			]
        ];
    }
    public function attributes()
    {
        return [
            "staff"=>"Staff",
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