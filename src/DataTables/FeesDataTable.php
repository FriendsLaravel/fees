<?php

namespace Fol\Fees\DataTables;

use Fol\Fees\Models\Fees;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FeesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            
            ->addColumn('created_at', function($item){
                
               return $item->created_at->format('Y-m-d');
            })
            ->addColumn('action', function($item){
                $action ='';
                $action .= view('components.edit-link', ['href' => route('fees.show', $item->id)]);
                $action .= view('components.destroy-link', ['href' => route('fees.destroy', $item->id)]);
               if($item->status){
                   
                   $action .= '<input  data-id='.$item->id.' type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">'; 
               }else{
                   $action .= '<input  data-id='.$item->id.' type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">'; 
               }
               return $action;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Fees $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Fees $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('fees-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title(__('Id')),
            Column::make('code')->title(__('Code')),
            Column::make('amount')->title(__('amount')),
            Column::make('position')->title(__('Postion')),
            Column::make('created_at')->title(__('Created At')),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(180)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Fees_' . date('YmdHis');
    }
}
