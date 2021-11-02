<?php

namespace App\Http\Controllers;

use App\Http\Requests\AffiliateFindRequest;
use App\Models\Affiliate;
use App\Services\AffiliateService;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
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
            'defaultRecords' => Session::pull('contact_records', File::get($this->getDefaultRecordsPath())),
            'defaultOfficeLat' => Session::pull('office_latitude', self::DEFAULT_OFFICE_LATITUDE),
            'defaultOfficeLng' => Session::pull('office_longitude', self::DEFAULT_OFFICE_LONGITUDE),
            'defaultRangeKm' => Session::pull('range', self::DEFAULT_RANGE_KM),
            'foundAffiliates' => Session::pull('affiliates') ?: collect(),
            'message' => Session::pull('message'),
        ]);
    }

    public function index(): View
    {
        return $this->mainView();
    }

    public function find(AffiliateFindRequest $request): RedirectResponse
    {
        $service = new AffiliateService($range = $request->get('range'));
        $office = $request->getOfficeLocation();
        $allAffiliates = $request->getAffiliates();
        $affiliates = $allAffiliates
            ->filter(function (Affiliate $affiliate) use ($service, $office) {
                return $service->isInRadius($affiliate, $office);
            })
            ->sortBy(function (Affiliate $affiliate) {
                return $affiliate->getId();
            })
        ;

        $message = "Found {$affiliates->count()} from {$allAffiliates->count()} affiliates in a range of $range KM from {$office->toString()}";

        $withs = [
            'affiliates' => $affiliates,
            'message' => $message,
            'contact_records' => $request->get('contact_records'),
            'office_latitude' => $request->get('office_latitude'),
            'office_longitude' => $request->get('office_longitude'),
            'range' => $request->get('range'),
        ];

        return redirect(route('affiliates.show'))->with($withs);
    }
}
