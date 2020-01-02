<?php

namespace App\Admin\Controllers;

use App\Models\Member;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MemberController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '会员管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Member);
		$grid->quickSearch('openid','unionid','Nickname','Province','City');
        $grid->column('id', __('Id'));
        $grid->column('openid', __('Openid'));
        $grid->column('unionid', __('Unionid'));
        $grid->column('nickname', __('Nickname'));
        $grid->column('avatar', __('Avatar'));
        $grid->column('sex', __('Sex'));
        $grid->column('province', __('Province'));
        $grid->column('city', __('City'));
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
        $show = new Show(Member::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('openid', __('Openid'));
        $show->field('unionid', __('Unionid'));
        $show->field('nickname', __('Nickname'));
        $show->field('avatar', __('Avatar'));
        $show->field('sex', __('Sex'));
        $show->field('province', __('Province'));
        $show->field('city', __('City'));
        $show->field('access_token', __('Access token'));
        $show->field('ip', __('Ip'));
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
        $form = new Form(new Member);

        $form->text('openid', __('Openid'));
        $form->text('unionid', __('Unionid'));
        $form->text('nickname', __('Nickname'));
        $form->image('avatar', __('Avatar'));
        $form->text('sex', __('Sex'));
        $form->text('province', __('Province'));
        $form->text('city', __('City'));
        $form->text('access_token', __('Access token'));
        $form->ip('ip', __('Ip'));
        $form->date('created_date', __('Created date'))->default(date('Y-m-d'));

        return $form;
    }
}
