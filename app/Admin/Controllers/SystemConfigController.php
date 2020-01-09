<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Tab;
use App\Admin\Forms\Basic;
use App\Admin\Forms\Site;

class SystemConfigController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
  	protected $header = '系统配置';

    public function index(Content $content)
    {
      	$forms = [
            'basic'    => Basic::class,
            'site'     => Site::class
        ];

        return $content
          	->header($this->header)
          	->description('选项卡')
            ->body(Tab::forms($forms));
    }
  
}
