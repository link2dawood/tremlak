<?php 
namespace App\Services;

use Google_Client;
use Google_Service_AnalyticsData;

class GoogleAnalyticsService
{
	protected $analytics;

	public function __construct()
	{
		$client = new Google_Client();
		$client->setAuthConfig(storage_path('google-analytics.json'));
		$client->addScope(Google_Service_AnalyticsData::ANALYTICS_READONLY);

		$this->analytics = new Google_Service_AnalyticsData($client);
	}
    public function getVisitorsByDate()
    {
    $propertyId = '479942280'; // Your GA4 property ID

    $request = new \Google_Service_AnalyticsData_RunReportRequest([
        'dateRanges' => [['startDate' => '7daysAgo', 'endDate' => 'today']], // Fetch last 7 days
        'metrics' => [['name' => 'activeUsers']],
        'dimensions' => [['name' => 'date']],
        'orderBys' => [['dimension' => ['dimensionName' => 'date'], 'desc' => true]],
    ]);

    $response = $this->analytics->properties->runReport("properties/$propertyId", $request);

    $visitorsByDate = [];
    $rows = $response->getRows();

    if (!empty($rows)) {
        foreach ($rows as $row) {
            $date = $row->getDimensionValues()[0]->getValue(); // Date
            $visitors = $row->getMetricValues()[0]->getValue(); // Total visitors
            $visitorsByDate[] = [
                'visit_date' => \Carbon\Carbon::createFromFormat('Ymd', $date)->format('Y-m-d'),
                'total_visitors' => $visitors
            ];
        }
    }

    return $visitorsByDate;
}
public function getVisitorsByCountryForDate($date)
{
    $propertyId = '479942280'; // Your GA4 property ID

    $request = new \Google_Service_AnalyticsData_RunReportRequest([
        'dateRanges' => [['startDate' => $date, 'endDate' => $date]],
        'metrics' => [['name' => 'activeUsers']],
        'dimensions' => [['name' => 'country']],
    ]);

    $response = $this->analytics->properties->runReport("properties/$propertyId", $request);

    $countries = [];
    $rows = $response->getRows();

    if (!empty($rows)) {
        foreach ($rows as $row) {
            $country = $row->getDimensionValues()[0]->getValue();
            $visitors = $row->getMetricValues()[0]->getValue();
            $countries[] = ['country' => $country, 'total' => $visitors];
        }
    }

    return $countries;
}

public function getTodayVisitors()
{
    $propertyId = '479942280'; // Ensure this is numeric

    $request = new \Google_Service_AnalyticsData_RunReportRequest([
    	'dateRanges' => [['startDate' => 'today', 'endDate' => 'today']],
    	'metrics' => [['name' => 'activeUsers']],
    ]);

    $response = $this->analytics->properties->runReport("properties/$propertyId", $request);

    // Check if rows exist before accessing them
    $rows = $response->getRows();
    if (!empty($rows) && isset($rows[0])) {
    	return $rows[0]->getMetricValues()[0]->getValue() ?? 0;
    } else {
        return 0; // No data available
    }
}
public function getVisitorsByCountry()
{
        $propertyId = '479942280'; // Replace with your correct numeric GA4 property ID

        $request = new \Google_Service_AnalyticsData_RunReportRequest([
        	'dateRanges' => [['startDate' => 'today', 'endDate' => 'today']],
        	'metrics' => [['name' => 'activeUsers']],
        	'dimensions' => [['name' => 'country']],
        ]);

        $response = $this->analytics->properties->runReport("properties/$propertyId", $request);

        $countries = [];
        $rows = $response->getRows();

        if (!empty($rows)) {
        	foreach ($rows as $row) {
        		$country = $row->getDimensionValues()[0]->getValue();
        		$visitors = $row->getMetricValues()[0]->getValue();
        		$countries[$country] = $visitors;
        	}
        }

        return $countries; // Returns an associative array ['USA' => 20, 'India' => 15, ...]
    }
}
