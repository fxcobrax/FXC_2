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
use App\Models\Admin\Classes;
use App\Models\Admin\Department;
use App\Models\Admin\Clubs;
use App\Models\Admin\Dorms;
use App\Models\Admin\Routes;
use App\Http\Controllers\Traits\Admin\AdmikoFileUploadTrait;
use App\Http\Controllers\Traits\Admin\AdmikoAuditableTrait;
use App\Http\Controllers\Traits\Admin\AdmikoMultiTenantModeTrait;

class StudentsList extends Model
{
    use AdmikoFileUploadTrait,AdmikoAuditableTrait,AdmikoMultiTenantModeTrait;

    public $table = 'students_list';
    
    
	static $admiko_file_info = [
		"student_picture"=>[
			"original"=>["action"=>"resize","width"=>1920,"height"=>1080,"folder"=>"upload/"]
		]
	];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"first_name",
		"gender",
		"date_of_birth",
		"national_id",
		"email",
		"phone_number",
		"student_picture",
		"student_picture_admiko_delete",
		"residential_address",
		"digital_address",
		"popular_landmark",
		"fullname",
		"occupation",
		"address",
		"phone_number1",
		"select_class",
		"select_department",
		"select_club",
		"dormitory_name",
		"select_route",
    ];
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
	public function setStudentPictureAttribute()
    {
        if (request()->hasFile('student_picture')) {
            $this->attributes['student_picture'] = $this->imageUpload(request()->file("student_picture"), StudentsList::$admiko_file_info["student_picture"], $this->getOriginal('student_picture'));
        }
    }
    public function setStudentPictureAdmikoDeleteAttribute($value)
    {
        if (!request()->hasFile('student_picture') && $value == 1) {
            $this->attributes['student_picture'] = $this->imageUpload('', StudentsList::$admiko_file_info["student_picture"], $this->getOriginal('student_picture'), $value);
        }
    }
	public function select_class_id()
    {
        return $this->belongsTo(Classes::class, 'select_class');
    }
	public function select_department_id()
    {
        return $this->belongsTo(Department::class, 'select_department');
    }
	public function select_club_id()
    {
        return $this->belongsTo(Clubs::class, 'select_club');
    }
	public function dormitory_name_id()
    {
        return $this->belongsTo(Dorms::class, 'dormitory_name');
    }
	public function select_route_id()
    {
        return $this->belongsTo(Routes::class, 'select_route');
    }
}