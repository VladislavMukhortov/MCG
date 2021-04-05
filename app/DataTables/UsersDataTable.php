<?php

namespace App\DataTables;

use App\Users;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Repositories\UserRepositoryRepositoryEloquent;

class UsersDataTable extends DataTable
{

    protected $userRepository;
    public function __construct(UserRepositoryRepositoryEloquent $userRepository){
        $this->userRepository = $userRepository;
    } 
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
            ->addColumn('action', 'usersdatatable.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\UsersDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UserRepositoryRepositoryEloquent $model)
    {
      
        return $this->userRepository->all();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        
     
        return $this->builder()
                    ->setTableId('users-table')
                    ->setTableAttributes(['class'=>'datatable-init nk-tb-list nk-tb-ulist'])
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
          
            Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            Column::make('status'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
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
        return 'Users_' . date('YmdHis');
    }

   
}
