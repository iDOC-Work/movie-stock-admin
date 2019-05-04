<?php

namespace App\Admin\Controllers;

use App\Members;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class MembersController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Members);

        // $grid->id('Id');
        // $grid->name('Name');
        // $grid->description('Description');
        // $grid->picture('Picture');
        // $grid->email('Email');
        // $grid->active('Active');
        // $grid->age('Age');
        // $grid->created_at('Created at');
        // $grid->updated_at('Updated at');
        
        $grid->id('ID')->sortable();
        $grid->column('name');

        $grid->picture('picture')->image();
        $grid->column('email');

        $grid->active()->value(function ($active) {
            return $active ?
                "<i class='fa fa-check' style='color:green'></i>" :
                "<i class='fa fa-close' style='color:red'></i>";
        });

        $grid->column('age');

        $grid->created_at();
        $grid->updated_at();

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
        $show = new Show(Members::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->description('Description');
        $show->picture('Picture');
        $show->email('Email');
        $show->active('Active');
        $show->age('Age');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Members);

        $form->text('name', 'Name');
        $form->textarea('description', 'Description');
        $form->image('picture', 'Picture');
        $form->email('email', 'Email');
        $form->switch('active', 'Active');
        $form->number('age', 'Age');

        return $form;
    }
}
