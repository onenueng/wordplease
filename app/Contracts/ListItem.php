<?php

namespace App\Contracts;

interface ListItem
{
    /**
     * Get fields whiches selected for query.
     *
     * @return array
     */
    public static function selectFields();

    /**
     * Get fields whiches make where(or) in the query.
     *
     * @return array
     */
    public static function whereFields();

    /**
     * Get list of list.
     *
     * @return array
     */
    public static function getList($keyWord);
}
