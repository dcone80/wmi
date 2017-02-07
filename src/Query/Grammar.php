<?php

namespace Stevebauman\Wmi\Query;

class Grammar
{
    /**
     * Compiles the given Builder into a SQL string.
     *
     * @param Builder $builder
     *
     * @return string
     */
    public function compile(Builder $builder)
    {
        return $this->concatenate([
            $this->compileSelects($builder),
            $this->compileFrom($builder),
            $this->compileWithin($builder),
            $this->compileWheres($builder),
        ]);
    }

    /**
     * Compiles the select columns on the given builder.
     *
     * @param Builder $query
     *
     * @return string
     */
    protected function compileSelects(Builder $query)
    {
        // We'll filter the select columns from containing null / empty values.
        $columns = array_filter($query->columns);

        if (empty($columns)) {
            $columns = ['*'];
        }

        return trim('select ' . $this->concatenate($columns, ', '));
    }

    /**
     * Compiles the from statement on the given builder.
     *
     * @param Builder $query
     *
     * @return string
     */
    protected function compileFrom(Builder $query)
    {
        return trim("from {$query->from}");
    }

    /**
     * Compile the within statement on the given builder.
     *
     * @param Builder $query
     *
     * @return string
     */
    protected function compileWithin(Builder $query)
    {
        if (!empty($query->within)) {
            return trim("within {$query->within}");
        }

        return '';
    }

    /**
     * Compiles wheres on the given query.
     *
     * @param Builder $query
     *
     * @return string
     */
    protected function compileWheres(Builder $query)
    {
        $wheres = [];

        foreach ($query->wheres as $key => $where) {
            list ($field, $operator, $value, $boolean) = array_values($where);

            $wheres[] = $this->compileWhere($boolean, $field, $operator, $value);
        }

        if (count($wheres) > 0) {
            $sql = implode(' ', $wheres);

            return 'where ' . $this->removeLeadingBoolean($sql);
        }

        return '';
    }

    /**
     * Compiles a single where statement.
     *
     * @param string $boolean
     * @param string $field
     * @param string $operator
     * @param string $value
     *
     * @return string
     */
    protected function compileWhere($boolean = 'and', $field, $operator, $value)
    {
        $value = addslashes(stripslashes($value));

        return "$boolean $field $operator '$value'";
    }

    /**
     * Concatenate an array of segments, removing empties.
     *
     * @param array  $segments
     * @param string $separator
     *
     * @return string
     */
    protected function concatenate(array $segments = [], $separator = ' ')
    {
        return implode($separator, array_filter($segments, function ($value) {
            return (string) $value !== '';
        }));
    }

    /**
     * Remove the leading boolean from a statement.
     *
     * @param  string  $value
     * @return string
     */
    protected function removeLeadingBoolean($value)
    {
        return preg_replace('/and |or /i', '', $value, 1);
    }
}
