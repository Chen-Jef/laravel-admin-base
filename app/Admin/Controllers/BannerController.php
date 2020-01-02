<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Banner;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BannerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '轮播图管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Banner);
		$grid->quickSearch('title');
		$grid->column('id', __('ID'));
        $grid->column('title', __('Title'));
        $grid->column('category_id', __('Categories'))->display(function ($category_id) {
            return Category::where('id', $category_id)->value('name');
        });
      	$grid->column('url', __('Url'))->link();
      	$states = [
            'on'  => ['value' => 1, 'text' => 'ON', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => 'OFF', 'color' => 'default'],
        ];
		$grid->column('status')->switch($states)->width(50);;
        $grid->column('image', __('Image'))->image('',40,40);
        $grid->column('created_date', __('Created date'));
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
        $show = new Show(Banner::findOrFail($id));

		$show->field('id', __('ID'));
        $show->field('title', __('Title'));
        $show->field('category_id', __('Categories'))->as(function ($category_id) {
            return Category::where('id', $category_id)->value('name');
        });
        $show->field('status', __('Status'))->using(['0' => '隐藏', '1' => '显示']);
        $show->field('image', __('Conver'))->image();
        $show->field('created_date', __('Created date'));
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
        $form = new Form(new Banner);

		$form->text('title', __('Title'));
        $form->select('category_id', __('Banner').__('Categories'))->options(function ($id) {
        	return Category::where('parent_id', 6)->pluck('name', 'id');
       	})->rules('required');
        $form->image('image', __('Image'))->thumbnail('small', $width = 300, $height = 300)->rules('required');
      	$form->text('url', __('Url'));
      	$form->number('order', __('Order'));
      	$form->switch('status', __('Status'));
        $form->date('created_date', __('Created date'))->default(date('Y-m-d'));

        return $form;
    }
}
