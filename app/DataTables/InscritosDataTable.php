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
                    'pagamento' => true,
                    'id' => $sql->id,
                    'onibus' => $sql->onibus ? true : false,
                    'msg' => $sql->msg
                ]);
            })
            ->editColumn('created_at', function($sql) {
                return $sql->criado_em;
            })
            ->addColumn('total_pago', function($sql) {
                return $sql->total_pago;
            })
            ->addColumn('total_pago_onibus', function($sql) {
                return $sql->total_pago_onibus;
            })
            ->editColumn('status', function($sql) {
                return '<span class="badge badge-'. Inscricao::LABELS[$sql->status]['label'] .'">'. Inscricao::LABELS[$sql->status]['text'] .'</span>';
            })

            ->editColumn('promocao', function($sql) {
                if (is_null($sql->promocao) || $sql->promocao == 'N') {
                    return  '';
                }
                return '<span class="badge badge-success">PROMOÇÃO</span>';
            })
            ->editColumn('onibus', function($sql) {
                if ($sql->onibus == 0) {
                    return  '';
                }
                return $sql->confirmacaoOnibus()->exists() ? '<span class="badge badge-success">Confirmado</span>' : '<span class="badge badge-danger">Pendente</span>';
            })
            ->rawColumns(['status', 'promocao', 'onibus']);
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
                        'buttons' => ['excel', 'print'],
                        'pageLength' => 50
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
            Column::make('total_pago')->title('Total Pago'),
            Column::make('total_pago_onibus')->title('Total Pago ônibus'),
            Column::make('status')->title('Status'),
            Column::make('onibus')->title('Ônibus'),
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
        return 'Inscricoes_' . date('YmdHis');
    }
}
