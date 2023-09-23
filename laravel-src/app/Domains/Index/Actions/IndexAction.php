<?php
namespace App\Domains\Index\Actions;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as Action;
use App\Domains\Portfolio\Actions\SingleAction as PortfolioAction;

class IndexAction extends Action
{
    public function run(Request $request) {
        return view(\Domain::view());
    }
}
