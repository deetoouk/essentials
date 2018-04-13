<?php

namespace DeeToo\Essentials\Utilities;

use Illuminate\Contracts\Pagination\Paginator;

class Grid
{
    public function generate(Paginator $paginator)
    {
        return [
            'page'    => $paginator->currentPage(),
            'pages'   => $paginator->lastPage(),
            'perpage' => $paginator->perPage(),
            'total'   => $paginator->total(),
            'from'    => $paginator->firstItem(),
            'to'      => $paginator->lastItem(),
            'records' => $paginator->getCollection()->toArray(),
        ];
    }
}
