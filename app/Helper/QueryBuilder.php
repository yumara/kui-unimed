<?php

namespace App\Helper;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QueryBuilder
{
    private mixed $query;

    private function __construct($query)
    {
        $this->query = $query;
    }

    public static function builder(Model|string $table): QueryBuilder
    {
        if (is_string($table)) {
            return new self(DB::table($table));
        }

        return new self($table::query());
    }

    public function select(array $select): QueryBuilder
    {
        $this->query->select($select);
        return $this;
    }

    public function selectRaw(string $select): QueryBuilder
    {
        $this->query->selectRaw($select);
        return $this;
    }

    public function where(array $values): QueryBuilder
    {
        $this->query->where($values);
        return $this;
    }

    public function whereNot(string $column, string $value): QueryBuilder
    {
        $this->query->where($column, '!=', $value);
        return $this;
    }

    public function whereLike(string $column, string $value): QueryBuilder
    {
        $this->query->where($column, 'like', "%$value%");
        return $this;
    }

    public function whereNotLike(string $column, string $value): QueryBuilder
    {
        $this->query->where($column, 'not like', "%$value%");
        return $this;
    }

    public function whereIn(string $column, array $values): QueryBuilder
    {
        $this->query->whereIn($column, $values);
        return $this;
    }

    public function whereNotIn(string $column, array $values): QueryBuilder
    {
        $this->query->whereNotIn($column, $values);
        return $this;
    }

    public function whereBetween(string $column, array $values): QueryBuilder
    {
        $this->query->whereBetween($column, $values);
        return $this;
    }

    public function whereBetweenColumns(string $column, array $columns): QueryBuilder
    {
        $this->query->whereBetweenColumns($column, $columns);
        return $this;
    }

    public function whereNotBetween(string $column, array $values): QueryBuilder
    {
        $this->query->whereNotBetween($column, $values);
        return $this;
    }

    public function whereNotBetweenColumns(string $column, array $columns): QueryBuilder
    {
        $this->query->whereNotBetweenColumns($column, $columns);
        return $this;
    }

    public function whereNull(string $column): QueryBuilder
    {
        $this->query->whereNull($column);
        return $this;
    }

    public function whereDate(string $column, string $value): QueryBuilder
    {
        $this->query->whereDate($column, $value);
        return $this;
    }

    public function whereDay(string $column, string $value): QueryBuilder
    {
        $this->query->whereDay($column, $value);
        return $this;
    }

    public function whereMonth(string $column, string $value): QueryBuilder
    {
        $this->query->whereMonth($column, $value);
        return $this;
    }

    public function whereYear(string $column, string $value): QueryBuilder
    {
        $this->query->whereYear($column, $value);
        return $this;
    }

    public function whereTime(string $column, string $value): QueryBuilder
    {
        $this->query->whereTime($column, $value);
        return $this;
    }

    public function whereExists($models)
    {
        $this->query->whereExists($models);
        return $this;
    }

    public function orWhere(array $values): QueryBuilder
    {
        $this->query->orWhere($values);
        return $this;
    }

    public function orWhereLike(string $column, string $value): QueryBuilder
    {
        $this->query->orWhere($column, 'like', "%$value%");
        return $this;
    }

    public function join(string $table, string $leftColumn, string $operator, string $rightColumn): QueryBuilder
    {
        $this->query->join($table, $leftColumn, $operator, $rightColumn);
        return $this;
    }

    public function leftJoin(string $table, string $leftColumn, string $operator, string $rightColumn): QueryBuilder
    {
        $this->query->leftJoin($table, $leftColumn, $operator, $rightColumn);
        return $this;
    }

    public function rightJoin(string $table, string $leftColumn, string $operator, string $rightColumn): QueryBuilder
    {
        $this->query->rightJoin($table, $leftColumn, $operator, $rightColumn);
        return $this;
    }

    public function crossJoin(string $table, string $leftColumn, string $operator, string $rightColumn): QueryBuilder
    {
        $this->query->crossJoin($table, $leftColumn, $operator, $rightColumn);
        return $this;
    }

    public function orderBy(array $orderBy): QueryBuilder
    {
        foreach ($orderBy as $column => $direction) {
            $this->query->orderBy($column, $direction);
        }

        return $this;
    }

    public function orderByAsc(string $column): QueryBuilder
    {
        $this->query->orderBy($column, 'asc');
        return $this;
    }

    public function orderByDesc(string $column): QueryBuilder
    {
        $this->query->orderBy($column, 'desc');
        return $this;
    }

    public function latest()
    {
        $this->query->latest();
        return $this;
    }

    public function withTrashed(bool $withTrashed): QueryBuilder
    {
        if ($withTrashed) {
            $this->query->withTrashed();
        }

        return $this;
    }

    public function paging(int $page, int $limitPerPage): QueryBuilder
    {
        if ($page > 0) {
            $this->query->offset(($page - 1) * $limitPerPage);
        }

        if ($limitPerPage > 0) {
            $this->query->limit($limitPerPage);
        }

        return $this;
    }

    public function build()
    {
        Log::debug(message: 'QUERY_BUILDER', context: [$this->query->toSql()]);
        return $this->query;
    }
}
