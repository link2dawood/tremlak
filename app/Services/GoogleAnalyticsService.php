<?php 
namespace App\Services;

use Google_Client;
use Google_Service_AnalyticsData;

class GoogleAnalyticsService
{
    protected $analytics;
    protected $propertyId;
    
    public function __construct()
    {
        try {
            $client = new Google_Client();
            
            // Load credentials from environment variable or config
            $credentialsPath = storage_path('google-analytics.json');
            if (!file_exists($credentialsPath)) {
                throw new \Exception('Google Analytics credentials file not found');
            }
            
            $client->setAuthConfig($credentialsPath);
            $client->addScope(Google_Service_AnalyticsData::ANALYTICS_READONLY);
            
            // Get property ID from config or env
            $this->propertyId = config('services.google.analytics_property_id', '483488627');
            
            // Format property ID correctly
            $this->propertyId = str_replace('properties/', '', $this->propertyId);
            
            $this->analytics = new Google_Service_AnalyticsData($client);
        } catch (\Exception $e) {
            \Log::error('Google Analytics initialization error: ' . $e->getMessage());
            throw $e;
        }
       
    }
    public function getVisitorsByDate()
    {
        $propertyId = '483488627'; // Your GA4 property ID
        
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
        $propertyId = '483488627'; // Your GA4 property ID
        
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
        try {
            $request = new \Google_Service_AnalyticsData_RunReportRequest([
                'property' => 'properties/' . $this->propertyId,
                'dateRanges' => [
                    [
                        'startDate' => 'today',
                        'endDate' => 'today'
                        ]
                    ],
                    'metrics' => [
                        [
                            'name' => 'activeUsers'
                            ]
                            ]
                        ]);
                        
                        $response = $this->analytics->properties->runReport(
                            'properties/' . $this->propertyId,
                            $request
                        );
                        
                        $rows = $response->getRows();
                        if (!empty($rows) && isset($rows[0])) {
                            return (int) $rows[0]->getMetricValues()[0]->getValue();
                        }
                        
                        return 0;
                    } catch (\Exception $e) {
                        \Log::error('Google Analytics API error: ' . $e->getMessage());
                        return 0;
                    }
        
                }
                public function getVisitorsByCountry()
                {
                    $propertyId = '483488627'; // Replace with your correct numeric GA4 property ID
                    
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
            