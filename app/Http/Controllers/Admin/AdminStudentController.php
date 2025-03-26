<?php

namespace App\Http\Controllers\Admin;

use App\Filters\FullNameFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AdminStudentController extends Controller
{
    public function __construct() {}

    public function index(): UserCollection
    {
        return new UserCollection(QueryBuilder::for(User::role('driver'))
            ->allowedFilters(AllowedFilter::custom('search', new FullNameFilter))
            ->paginate(self::PER_PAGE));
    }
}
