<?php

namespace Enraiged\Tables\Builders\Traits;

use Enraiged\Forms\Traits\SelectOptions;

trait TableFilters
{
    use SelectOptions;

    /** @var  array  The table filters. */
    protected array $filters = [];

    /**
     *  Assemble and return the table filters.
     *
     *  @return array
     */
    public function assembleTemplateFilters(): array
    {
        return collect($this->get('filters'))
            ->filter(fn ($filter) => $this->assertSecure($filter))
            ->transform(function ($filter, $index) {
                if (!key_exists('source', $filter)) {
                    $filter['source'] = "{$this->table}.{$index}";
                }

                if (key_exists('options', $filter)) {
                    $options = $filter['options'];

                    if (!key_exists('values', $options)) {
                        $filter['options'] = [...$options, ...$this->selectOptions($index, $options)];

                        if (!key_exists('type', $filter)) {
                            $filter['type'] = 'select';
                        }
                    }
                }

                if ($filter['type'] === 'daterange') {
                    if (key_exists('maximum', $filter)) {
                        $filter['maximum'] = datetime($filter['maximum'], 'Y-m-d');
                    }

                    if (key_exists('minimum', $filter)) {
                        $filter['minimum'] = datetime($filter['minimum'], 'Y-m-d');
                    }
                }

                return $filter;
            })
            ->toArray();
    }

    /**
     *  Explicitly set the default value for a specified table filter.
     *
     *  @param  strimg  $filter
     *  @param  mixed   $value
     *  @return self
     */
    public function setFilterDefault($filter, $value)
    {
        if (key_exists($filter, $this->filters)) {
            $this->filters[$filter]['default'] = $value;
        }

        return $this;
    }

    /**
     *  Explicitly set the default value for a specified table filter if the provided condition is true.
     *
     *  @param  strimg  $filter
     *  @param  mixed   $value
     *  @return self
     */
    public function setFilterDefaultIf($filter, $value, $condition)
    {
        if ($condition instanceof \Closure) {
            $condition = $condition();
        }

        if ($condition) {
            $this->setFilterDefault($filter, $value);
        }

        return $this;
    }
}
