<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\GpsCoordinate;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AffiliatesController extends Controller
{
    use ValidatesRequests;

    const DEFAULT_RECORDS_URL = 'affiliates.txt';
    const DEFAULT_OFFICE_LATITUDE = 53.3340285;
    const DEFAULT_OFFICE_LONGITUDE = -6.2535495;
    const DEFAULT_RANGE_KM = 100;

    private function getDefaultRecordsPath(): string
    {
        return public_path(self::DEFAULT_RECORDS_URL);
    }

    private function mainView(): View
    {
        return view('main')->with([
            'defaultRecords' => File::get($this->getDefaultRecordsPath()),
            'defaultOfficeLat' => self::DEFAULT_OFFICE_LATITUDE,
            'defaultOfficeLng' => self::DEFAULT_OFFICE_LONGITUDE,
            'defaultRangeKm' => self::DEFAULT_RANGE_KM,
            'foundAffiliates' => Session::pull('affiliates') ?: collect(),
            'message' => Session::pull('message'),
        ]);
    }

    public function index(): View
    {
        return $this->mainView();
    }

    public function find(Request $request): RedirectResponse
    {
        $affiliate1 = new Affiliate(12, 'test1', new GpsCoordinate(12,12));
        $affiliate2 = new Affiliate(13, 'test2', new GpsCoordinate(12,12));
        $affiliates = collect([$affiliate1]);
        $affiliates->push($affiliate2);
        $message = 'OK';

        return redirect(route('affiliates.show'))->with(['affiliates' => $affiliates, 'message' => $message]);
    }
}
