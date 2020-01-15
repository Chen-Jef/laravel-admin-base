<?php

namespace App\Admin\Controllers;

use App\Models\Message;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MessageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '留言管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Message);

        $grid->column('nickname', __('Nickname'));
        $grid->column('content', __('Content'));
        $grid->column('type', __('Type'));
        $grid->column('contact', __('Contact'));
        $grid->column('ip', __('Ip'));
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
        $show = new Show(Message::findOrFail($id));

        $show->field('nickname', __('Nickname'));
        $show->field('content', __('Content'));
        $show->field('type', __('Type'));
        $show->field('contact', __('Contact'));
        $show->field('ip', __('Ip'));
        $show->field('created_date', __('Created date'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
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
        $form = new Form(new Message);



        return $form;
    }
}
