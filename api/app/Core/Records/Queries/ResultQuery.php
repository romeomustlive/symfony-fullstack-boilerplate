<?php


namespace App\Core\Records\Queries;


use Illuminate\Http\Request;

interface ResultQuery
{
    public function getById(int $id);

    public function getByFilter(Request $request);
}
