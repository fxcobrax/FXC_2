<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Elements;
use Carbon\Carbon;
use App\Http\Controllers\Traits\Admin\AdmikoFileUploadTrait;
use App\Http\Controllers\Traits\Admin\AdmikoAuditableTrait;
use App\Http\Controllers\Traits\Admin\AdmikoMultiTenantModeTrait;

class Staffs extends Model
{
    use AdmikoFileUploadTrait,AdmikoAuditableTrait,AdmikoMultiTenantModeTrait;

    public $table = 'staffs';
    
    
	static $admiko_file_info = [
		"picture"=>[
			"original"=>["action"=>"resize","width"=>1920,"height"=>1080,"folder"=>"upload/"]
		],
		"document"=>[
			"original"=>["folder"=>"upload/"]
		]
	];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"role",
		"full_name",
		"gender",
		"date_of_birth",
		"address",
		"picture",
		"picture_admiko_delete",
		"phone_number",
		"email",
		"document",
		"document_admiko_delete",
		"contract_type",
		"salary",
    ];
    public function role_id()
    {
        return $this->belongsTo(Elements::class, 'role');
    }
	public function gender_id()
    {
        return $this->belongsTo(Elements::class, 'gender');
    }
	public function getDateOfBirthAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('admiko_config.table_date_time_format')) : null;
    }
    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = $value ? Carbon::createFromFormat(config('admiko_config.table_date_time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
	public function setPictureAttribute()
    {
        if (request()->hasFile('picture')) {
            $this->attributes['picture'] = $this->imageUpload(request()->file("picture"), Staffs::$admiko_file_info["picture"], $this->getOriginal('picture'));
        }
    }
    public function setPictureAdmikoDeleteAttribute($value)
    {
        if (!request()->hasFile('picture') && $value == 1) {
            $this->attributes['picture'] = $this->imageUpload('', Staffs::$admiko_file_info["picture"], $this->getOriginal('picture'), $value);
        }
    }
	public function setDocumentAttribute()
    {
        if (request()->hasFile('document')) {
            $this->attributes['document'] = $this->fileUpload(request()->file("document"), Staffs::$admiko_file_info["document"], $this->getOriginal('document'));
        }
    }
    public function setDocumentAdmikoDeleteAttribute($value)
    {
        if (!request()->hasFile('document') && request()->document_admiko_delete == 1) {
            $this->attributes['document'] = $this->fileUpload('', Staffs::$admiko_file_info["document"], $this->getOriginal('document'), $value);
        }
    }
	public function contract_type_id()
    {
        return $this->belongsTo(Elements::class, 'contract_type');
    }
	public function getSalaryAttribute($value)
    {
        return $value ? round($value, 2) : null;
    }
}