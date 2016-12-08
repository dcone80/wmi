<?php

namespace Stevebauman\Wmi\Query;

class Grammar
{
    public function compile(Builder $builder)
    {
        $components = [
            $this->compileSelects($builder),
            $this->compileFrom($builder),
            $this->compileWithin($builder),
            $this->compileWheres($builder),
        ];

        $query = implode(' ', $components);

        //dd($this->compileWheres($builder));

        dd($query);
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
        if (is_null($query->columns)) {
            $query->columns = ['*'];
        }

        $sql = trim('select ' . $this->concatenate($query->columns, ', '));

        return $sql;
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
        return trim("within {$query->within}");
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
    protected function concatenate($segments, $separator = ' ')
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
