<?php

namespace App\DataTables;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;
class TopicsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Topic> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('title', function ($query) {
                return $query->title;
            })
            ->addColumn('created_date', function ($query) {
                return $query->created_date ? Carbon::parse($query->created_date)->format('Y-m-d H:i:s') : 'N/A';
            })
            ->addColumn('description', function ($query) {
                return $query->description ? substr($query->description, 0, 50) . '...' : 'No description';
            })
            ->addColumn('created_by', function ($query) {
                return $query->member ? $query->member->name : 'N/A';
            })
            ->rawColumns(['description', 'created_by']);
            
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Topic>
     */
    public function query(Topic $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('topics-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    // ->orderBy(1)
                    ->selectStyleSingle()
                    ->parameters([
                        'order' => [],
                    ])
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')->title('S.No.')->searchable(false)->orderable(false)->addClass('text-center'),
            Column::make('title')->title('title')->orderable(false)->addClass('text-center'),
            Column::make(data: 'created_date')->title('Date & Time')->orderable(false)->addClass('text-center'),
            Column::computed(data: 'description')->title('Description')->searchable(false)->orderable(false)->addClass('text-center'),
            Column::computed(data: 'created_by')->title('Created By')->searchable(false)->orderable(false)->addClass('text-center')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Topics_' . date('YmdHis');
    }
}
