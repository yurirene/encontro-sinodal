<?php

namespace App\DataTables;

use App\Models\Camisa;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CamisaDataTable extends DataTable
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
            ->addColumn('action', function($sql) {
                return view('includes.actions', [
                    'route' => 'camisas',
                    'onibus' => false,
                    'edit' => false,
                    'delete' => false,
                    'id' => $sql->id,
                    'status' => true
                ]);
            })
            ->editColumn('created_at', function($sql) {
                return $sql->criado_em;
            })
            ->editColumn('status', function($sql) {
                return '<span class="badge badge-'. Camisa::LABELS[$sql->status]['label'] .'">'. Camisa::LABELS[$sql->status]['text'] .'</span>';
            })
            ->rawColumns(['status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Camisa $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Camisa $model)
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
                    ->setTableId('camisas-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1, 'desc')
                    ->parameters([
                        'language' => [
                            "url" => "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
                        ],
                        'buttons' => ['excel']
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
                  ->title('Ação'),
            Column::make('nome')->title('Nome'),
            Column::make('quantidade')->title('Quantidade'),
            Column::make('federacao')->title('Federação'),
            Column::make('igreja')->title('Igreja'),
            Column::make('celular')->title('Celular'),
            Column::make('status')->title('Status'),
            Column::make('tamanho')->title('Tamanho'),
            Column::make('created_at')->title('Solicitado Em'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Camisas_' . date('YmdHis');
    }
}
