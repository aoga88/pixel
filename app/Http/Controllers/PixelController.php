<?php
namespace App\Http\Controllers;

use App\RequestQuery;
use App\Requests;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PixelController extends Controller {

    public function index(Request $request) {
        $dbRequest = new Requests();
        $dbRequest->host = $request->getHttpHost();
        $dbRequest->query = $request->getQueryString();
        $dbRequest->ip = $request->ip();
        $dbRequest->agent = $request->header('User-Agent');
        $dbRequest->referer = $request->header('referer');
        $dbRequest->save();

        $params = $request->query();
        foreach ($params as $index => $param) {
            $query = new RequestQuery();
            $query->name = $index;
            $query->value = $param;
            $query->request_id = $dbRequest->id;
            $query->save();
        }

        $base64 = 'R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
        return response(base64_decode($base64))->header('Content-type', 'image/gif');
    }

}