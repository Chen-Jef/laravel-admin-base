<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '文章管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article);
		$grid->quickSearch('title','description');
        $grid->column('id', __('ID'));
        $grid->column('title', __('Title'));
        $grid->column('category_id', __('Categories'))->display(function ($category_id) {
            return Category::where('id', $category_id)->value('name');
        });
        $grid->column('description', __('Description'));
        $grid->column('comments', __('Comments'))->editable();
        $grid->column('favs', __('Favs'))->editable();;
        //$grid->column('status', __('Status'))->using(['0' => '隐藏', '1' => '显示'])->label(['隐藏'=>'default','显示'=>'success']);
      	$states = [
            'on'  => ['value' => 1, 'text' => 'ON', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => 'OFF', 'color' => 'default'],
        ];
		$grid->column('status')->switch($states)->width(50);;
        $grid->column('conver', __('Conver'))->image('',40,40);
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
        $show = new Show(Article::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('title', __('Title'));
        $show->field('category_id', __('Categories'))->as(function ($category_id) {
            return Category::where('id', $category_id)->value('name');
        });
        $show->field('description', __('Description'));
        $show->field('content', __('Content'));
        $show->content(__('Content'))->unescape()->as(function ($content) {
            return "<pre>{$content}</pre>";
        });
        $show->field('comments', __('Comments'));
        $show->field('favs', __('Favs'));
        $show->field('status', __('Status'))->using(['0' => '隐藏', '1' => '显示']);
        $show->field('conver', __('Conver'))->image();
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
        $form = new Form(new Article);

        $form->text('title', __('Title'));
        $form->select('category_id', __('Articles').__('Categories'))->options(function ($id) {
        	return Category::where('parent_id', 1)->pluck('name', 'id');
       	})->rules('required');
        $form->text('description', __('Description'));
        $form->simditor('content',__('Content'));
        $form->number('comments', __('Comments'));
        $form->number('favs', __('Favs'));
        $form->switch('status', __('Status'));
        $form->image('conver', __('Conver'))->thumbnail('small', $width = 300, $height = 300);
        $form->date('created_date', __('Created date'))->default(date('Y-m-d'));

        return $form;
    }
}
