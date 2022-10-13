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

class IncomeRequest extends FormRequest
{
    public function rules()
    {
        return [
            "amount"=>[
				"numeric",
				"required",
				"min:1"
			],
			"description"=>[
				"string",
				"required"
			]
        ];
    }
    public function attributes()
    {
        return [
            "amount"=>"Amount",
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