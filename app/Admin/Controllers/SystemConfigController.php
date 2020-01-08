<?php

namespace App\Admin\Controllers;

use App\Models\SystemConfig;
use App\Models\VariableType;
use App\Models\SystemConfigGroup;
use App\Http\Controllers\Api\SystemConfigController as SystemConfigApi;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Field\Interaction\FieldTriggerTrait;
use Field\Interaction\FieldSubscriberTrait;

class SystemConfigController extends AdminController
{
  	use FieldTriggerTrait, FieldSubscriberTrait;
  
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '系统配置';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SystemConfig);
      
      	$grid->quickSearch('title', 'group');
      
      	$grid->column('id', __('ID'))->sortable();;
      	$grid->column('title', __('Variable Title'));
     	$grid->column('group',__('Variable Group'))->display(function($group){
          	$SystemConfigApi = new SystemConfigApi;
        	$groups = $SystemConfigApi->getVariableGroup();
          	foreach ($groups as $value){
            	if($value['id'] == $group){
                	return $value['text'];
                }
            }
        });
      	//$grid->column('variable_type.name', __('Variable Type'));
      	$grid->column('name', __('Variable Name'));
      	$grid->column('value', __('Variable Value'));
      	$grid->column('tip', __('Variable Tip'));
      
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
	
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(SystemConfig::findOrFail($id));

		$show->field('id', __('ID'));
        $show->field('name', __('Variable Name'));

        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;

    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SystemConfig);
      
      	$form->select('type', __('Variable Type'))
            ->options('/api/getVariableType');
      	
        $form->select('group', __('Variable Group'))
          	->options('/api/getVariableGroup');
      	$form->text('name', __('Variable Name'))->rules('required');
        $form->text('title', __('Variable Title'))->rules('required');
      	$param = request()->route()->parameters();
        if($param){
          $id = $param['system_config'];
          $system_config = SystemConfig::findOrFail($id);
          $type = $system_config->type;
          switch($type){
              case 'string':
                  $form->text('value', __('Variable Value'));
                  break;
              case 'number':
                  $form->number('value', __('Variable Value'));
                  break;
              case 'image':
                  $form->image('value', __('Variable Value'))->thumbnail('small', $width = 300, $height = 300);
                  break;
              case 'switch':
                  $states = [
                      'on'  => ['value' => 1, 'text' => 'ON', 'color' => 'success'],
                      'off' => ['value' => 0, 'text' => 'OFF', 'color' => 'danger'],
                  ];
                  $form->switch('value', __('Variable Value'))->states($states);
                  break;
              case 'select':
                  $form->table('content', function ($table) {
                      $table->text('id','key');
                      $table->text('text','value');
                  });
              		$content = $system_config->content;
              		$options = [];
              		foreach ($content as $key => $value){
                      	$option[$value['id']] = $value['text'];
                    	array_push($options,$option);
                    }
              		if(count($options)>0){
                      	$form->select('value', __('Variable Value'))->options($options[count($options)-1]);
                    }else{
                    	$form->select('value', __('Variable Value'))->options([]);
                    }
              		
                  
                  break;
              case 'radio':
                  $form->table('content', function ($table) {
                      $table->text('id','key');
                      $table->text('text','value');
                  });
              		$content = $system_config->content;
              		$options = [];
              		foreach ($content as $key => $value){
                      	$option[$value['id']] = $value['text'];
                    	array_push($options,$option);
                    }
              		if(count($options)>0){
                      	$form->radio('value', __('Variable Value'))->options($options[count($options)-1]);
                    }else{
                    	$form->radio('value', __('Variable Value'))->options([]);
                    }
                 
                  break;
              case 'check':
              		$form->table('content', function ($table) {
                      $table->text('id','key');
                      $table->text('text','value');
                  });
              		$content = $system_config->content;
              		$options = [];
              		foreach ($content as $key => $value){
                      	$option[$value['id']] = $value['text'];
                    	array_push($options,$option);
                    }
              		if(count($options)>0){
                      	$form->checkbox('value', __('Variable Value'))->options($options[count($options)-1])->canCheckAll();
                    }else{
                    	$form->checkbox('value', __('Variable Value'))->options([])->canCheckAll();
                    }
                  break;
              case 'text':
                  $form->textarea('value', __('Variable Value'))->rows(5);
                  break;
              case 'array':
                  $form->table('content', function ($table) {
                      $table->text('key');
                      $table->text('value');
                  });
                  break;
              default:
                  $form->text('value', __('Variable Value'));
                  break;
          }
        }else{
        	 $form->text('value', __('Variable Value'));
        }
     	
      	$form->select('rule', __('Variable Rule'))
            ->options('/api/getVariableRule');
      	$form->text('tip', __('Variable Tip'));
      
            	// 弄一个触发事件的Script对象。
      	$triggerScript = $this->createTriggerScript($form);
      
      	// 弄-个接收并处理事件的Script对象。
        $subscribeScript = $this->createSubscriberScript($form, function($builder) use($form){
           // 添加事件响应函数
           $builder->subscribe('type', 'select', function($event){
           // 这里填写处理事件的javascript脚本，注意：一定要返回一个完整的 javascript function ，否则报错！！！！
               return <<< EOT
               // function中的参数data，是事件自带数据，方便做逻辑处理！data会因为事件不同而类型不同，具体可以在chrome中的console中查看。
               function (data){
                    console.log(data.id)
               }
        EOT;
           });
          	
        });
      
        // 最后把 $triggerScript 和 $subscribeScript 注入到Form中去。
        $form->scriptinjecter('select_type_value', $triggerScript, $subscribeScript);

        return $form;
    }
  
}
