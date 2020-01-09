<?php

namespace App\Admin\Forms;

use App\Models\SystemConfig;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class Site extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '站点配置';

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
          	$info = SystemConfig::where(['group'=>'site','name'=>$key])->first();
          	$date_time = date('Y-m-d H:i:s');
          	if($info){
            	$sql = SystemConfig::where(['group'=>'site','name'=>$key])->update(['value' => $value,'updated_at'=>$date_time]);
            }else{
				$sql = SystemConfig::where(['group'=>'site','name'=>$key])->insert([
                	'name'=>$key,'group'=>'site','title'=>'','value' => $value,'type'=>'string','created_at'=>$date_time,'updated_at'=>$date_time
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
        $this->text('record_number','备案号')->rules('required');
      	$this->text('cdn','CDN地址');
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
      	$record_number = SystemConfig::where(['group'=>'site','name'=>'record_number'])->first();
      	$cdn = SystemConfig::where(['group'=>'site','name'=>'cdn'])->first();
      	return [
        	'record_number' => $record_number ? $record_number['value'] : '',
          	'cdn'=>$cdn ? $cdn['value'] : '',
        ];
    }
}
