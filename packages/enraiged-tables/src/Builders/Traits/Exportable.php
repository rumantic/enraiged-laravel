<?php

namespace Enraiged\Tables\Builders\Traits;

trait Exportable
{
    /** @var  int  The exportable chunk size. */
    protected int $chunksize;

    /** @var  array  The exportable parameters. */
    protected $exportable;

     /** @var  string  The exported file location. */
    protected string $exportpath;

     /** @var  string  The human readable filename. */
    protected string $filename;

     /** @var  string  The exported file type. */
    protected string $filetype;

    /** @var  string  The hashed (storage) filename. */
    protected string $hashname;

    /**
     *  Derive the name and location of the exportable data.
     *
     *  @return self
     */
    public function exportable()
    {
        $parameters = collect($this->request->get('export'));
        $storage = config('enraiged.tables.storage');

        $this->chunksize = $parameters->get('chunk') ?? config('excel.exports.chunk_size');
        $this->filename = trim_lower($parameters->get('name'));
        $this->filetype = trim_lower($parameters->get('type'));
        $this->hashname = uhash();
        $this->exportpath = "{$storage}/{$this->hashname}.{$this->filetype}";

        return $this;
    }

    /**
     *  Return the exporter service object.
     *
     *  @return object
     */
    public function exporter()
    {
        return $this->exporter::from($this);
    }

    /**
     *  Return the human readable filename with filetype.
     *
     *  @return string
     */
    public function filename()
    {
        return "{$this->filename}.{$this->filetype}";
    }

    /**
     *  Return the exported file location.
     *
     *  @return string
     */
    public function exportpath()
    {
        return $this->exportpath;
    }
}
