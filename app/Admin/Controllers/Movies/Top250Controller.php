<?php

namespace App\Admin\Controllers\Movies;

use App\Http\Controllers\Controller;
use App\Models\Movie\Top250;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class Top250Controller extends Controller
{
    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Top250');

            $content->body($this->grid());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Top250::class, function (Grid $grid) {

            $grid->title();

            $grid->images()->first()->image();
            $grid->year();
            $grid->rating()->display(function ($rating) {
                return $rating['average'];
            });
            $grid->directors()->pluck('name')->label('primary');

            $grid->casts()->pluck('name')->label();

            $grid->genres()->badge();

            $grid->disableActions();
            $grid->disableBatchDeletion();
            $grid->disableExport();
            $grid->disableCreation();
            $grid->disableFilter();

        });
    }
}