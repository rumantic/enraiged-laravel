<?php

namespace App\Datatables;
use App\Http\Resources\Realty\IndexResource;
use App\Models\Realty;
use Enraiged\Tables\Builders\TableBuilder;
use Enraiged\Tables\Contracts\ProvidesDefaultSort;
use Enraiged\Tables\Contracts\ProvidesTableQuery;
use Enraiged\Users\Tables\Exporters\IndexExporter;
use Enraiged\Users\Traits\Assertions\AssertIsDeleted;
use Enraiged\Users\Traits\Assertions\AssertIsNotDeleted;
use Illuminate\Database\Eloquent\Builder;

class RealtyIndex extends TableBuilder implements ProvidesDefaultSort, ProvidesTableQuery
{
    use AssertIsDeleted, AssertIsNotDeleted;

    /** @var  string  The exporter service. */
    protected $exporter = IndexExporter::class;

    /** @var  string  The data model. */
    protected string $model = Realty::class;

    /** @var  string  The model resource. */
    protected $resource = IndexResource::class;

    /** @var  string  The template json file path. */
    protected string $template = __DIR__.'/../Templates/realty-index.json';

    /**
     *  Apply default sort criteria to this table builder.
     *
     *  @return void
     */
    public function defaultSort()
    {
        $this->builder
            ->orderBy('realty.id');
    }

    /**
     *  Provide the initial query builder for this table.
     *
     *  @return \Illuminate\Database\Eloquent\Builder
     */

    public function query(): Builder
    {
        //return $this->nonResourceBuild();

        return Realty::query();
    }

}
