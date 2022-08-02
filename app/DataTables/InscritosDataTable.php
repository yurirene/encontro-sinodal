<?php

namespace App\DataTables;

use App\Models\Inscricao;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InscritosDataTable extends DataTable
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
                    'route' => 'inscritos',
                    'id' => $sql->id,
                    'onibus' => $sql->onibus ? true : false,
                    'msg' => $sql->msg
                ]);
            })
            ->editColumn('created_at', function($sql) {
                return $sql->criado_em;
            })
            ->editColumn('status', function($sql) {
                return '<span class="badge badge-'. Inscricao::LABELS[$sql->status]['label'] .'">'. Inscricao::LABELS[$sql->status]['text'] .'</span>';
            })

            ->editColumn('promocao', function($sql) {
                if (is_null($sql->promocao)) {
                    return  '';
                }
                return '<span class="badge badge-success">PROMOÇÃO</span>';
            })
            ->rawColumns(['status', 'promocao']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Inscricao $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Inscricao $model)
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
                    ->setTableId('inscritos-datatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(8, 'desc')
                    ->parameters([
                        'language' => [
                            "url" => "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
                        ],
                        'buttons' => []
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
            Column::make('promocao')->title('Promoção'),
            Column::make('federacao')->title('Federação'),
            Column::make('igreja')->title('Igreja'),
            Column::make('celular')->title('Celular'),
            Column::make('tipo_pagamento')->title('Pagamento'),
            Column::make('quantidade_parcelas')->title('Parcelas'),
            Column::make('status')->title('Status'),
            Column::make('promocao')->title('Promoção'),
            Column::make('created_at')->title('Inscrito Em'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Inscricaos_' . date('YmdHis');
    }
}
