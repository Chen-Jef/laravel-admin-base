<?php

namespace App\Admin\Forms;

use App\Models\SystemConfig;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class Basic extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '基础配置';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
       	$data = $request->all();
      	
      	foreach($data as $key => $value){
          	$info = SystemConfig::where(['group'=>'basic','name'=>$key])->first();
          	$date_time = date('Y-m-d H:i:s');
          	$data_type = gettype($value);
          	$type = 'string';
          	if($data_type !== 'string'){
            	switch($data_type){
                  	case 'object':                	
                  		$type = 'image';
                    	$value = $request->file($key)->store(config('admin.upload.directory.image'), 'admin');
                    	break;
                }
            }
          	if($info){
            	$sql = SystemConfig::where(['group'=>'basic','name'=>$key])->update(['value' => $value,'type'=>$type,'updated_at'=>$date_time]);
            }else{
				$sql = SystemConfig::where(['group'=>'basic','name'=>$key])->insert([
                	'name'=>$key,'group'=>'basic','title'=>'','value' => $value,'type'=>$type,'created_at'=>$date_time,'updated_at'=>$date_time
                ]);            
            }
        }

        admin_success('Processed successfully.');

        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
      	
        $this->text('project_name','项目名称')->rules('required');
      	$this->image('logo','Logo');
       	$this->text('version','版本号')->rules('required');

    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
      	$project_name = SystemConfig::where(['group'=>'basic','name'=>'project_name'])->first();
      	$logo = SystemConfig::where(['group'=>'basic','name'=>'logo'])->first();
      	$version = SystemConfig::where(['group'=>'basic','name'=>'version'])->first();
      	return [
        	'project_name' => $project_name ? $project_name['value'] : '',
          	'logo'=>$logo ? $logo['value'] : '',
          	'version'=>$version ? $version['value'] : '',
        ];
    }
}
