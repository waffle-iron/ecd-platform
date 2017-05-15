<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\Interfaces\CentreRepositoryInterface;
use App\Traits\TokenUser;

class CentreController extends Controller
{
    use TokenUser;

    protected $centre;
    protected $currentUser;

    public function __construct(CentreRepositoryInterface $centreRepository)
    {
        $this->centre = $centreRepository;
        $this->currentUser = $this->getCurrentUser();
        $this->middleware('token.auth')->only('summary');
    }

    public function indexByPublic()
    {
        return response()->json($this->centre->allFiltered());
    }

    public function summary($centreId)
    {
        return response()->json($this->centre->summaryClassesChildren($centreId));
    }
}
