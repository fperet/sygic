<?php

namespace Azoft\SygicBundle\Service;

use Circle\RestClientBundle\Services\RestClient;

class Sygic
{
    public function __construct(RestClient $restClient, $apiKey)
    {
        $this->apiKey     = $apiKey;
        $this->restClient = $restClient;

        $this->baseUrl        = 'https://api.jobdispatch.sygic.com';//apihelp/api-docs';
    }

    public function listJobs()
    {
        $dataArray = array(
            'conditionFilter' => array(
                'createdDateFrom' => '',
                'createdDateTo' => '',
                'startDateFrom' => '',
                'startDateTo' => '',
                'endDateFrom' => '',
                'endDateTo' => '',
                'customData' => '',
                'jobStatus' => '',
                'assignedTo' => 0,
                'page' => 0,
                'pageSize' => 20,
                'includeDeleted' => false,
            )
        );

        $data = http_build_query($dataArray);

        $url = $this->baseUrl . '/api/v1/jobs' . '?api_key=' . $this->apiKey;

        $response = $this->restClient->get($url . '&' . $data , array(
        ));

        $content = $response->getContent();
        $content = json_decode($content);

        return $content;
    }

    public function createJob()
    {
        $url = $this->baseUrl . '/api/v1/jobs' . '?api_key=' . $this->apiKey;

        $job = array (
            'customData' => '',
            'name' => 'Job template',
            'details' => 'some details',
            'startDate' => '',
            'endDate' => '',
            'assignedUserId' => 0,
            'rules' =>
                array (
                    0 =>
                        array (
                            'ruleType' => '',
                            'data' => '',
                        ),
                ),
            'tasks' =>
                array (
                    0 =>
                        array (
                            'name' => '',
                            'contactName' => '',
                            'contactPhone' => '',
                            'details' => '',
                            'address' => '',
                            'longitude' => 0,
                            'latitude' => 0,
                            'startDate' => '',
                            'endDate' => '',
                            'barcodeType' => '',
                            'barcodes' =>
                                array (
                                    0 =>
                                        array (
                                            'barcodeValue' => '',
                                            'name' => '',
                                        ),
                                ),
                            'customFields' =>
                                array (
                                    0 =>
                                        array (
                                            'customFieldType' => '',
                                            'name' => '',
                                            'value' => '',
                                            'order' => 0,
                                            'required' => false,
                                        ),
                                ),
                        ),
                ),
        );

        return $this->restClient->post($url, array('job' => $job));
    }
}