<?php

namespace App\Admin\Controllers;

use App\Models\Zone;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ZoneController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Zones';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Zone());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Zone'));
        $grid->column('Polygon')->display(function () {
            return "<a href='/admin/create_zones/".$this->id."'><span class='label label-warning'>Create Polygon</span></a>";
        });
        $grid->column('View Polygon')->display(function () {
            return "<a href='/admin/view_zones/".$this->id."'><span class='label label-warning'>View Polygon</span></a>";
        });
        $grid->disableExport();
        
        if(env('MODE') == 'DEMO'){
            $grid->disableActions();
            $grid->disableExport();
            $grid->disableRowSelector();
            //$grid->disableCreateButton();
        }else{
            $grid->actions(function ($actions) {
                $actions->disableView();
            });
        }

        return $grid;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Zone());
        $form->text('name', __('Zone'))->rules('required');
        $form->hidden('polygon', __('Polygon'));
        $form->tools(function (Form\Tools $tools) {
           $tools->disableDelete(); 
           $tools->disableView();
        });
        $form->footer(function ($footer) {
           $footer->disableViewCheck();
           $footer->disableEditingCheck();
           $footer->disableCreatingCheck();
        });

        return $form;
    }
}
