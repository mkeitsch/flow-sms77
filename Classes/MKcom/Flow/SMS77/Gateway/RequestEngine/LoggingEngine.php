<?php
namespace MKcom\Flow\SMS77\Gateway\RequestEngine;

/*
 * This file is part of the MKcom.Flow.SMS77 package.
 */

use TYPO3\Flow\Annotations as Flow;
use MKcom\Flow\SMS77\Gateway\RequestEngineInterface;
use TYPO3\Flow\Log\SystemLoggerInterface;

/**
 * Class LoggingEngine
 *
 * @package MKcom\Flow\SMS77\Gateway\RequestEngine
 *
 * @Flow\Scope("singleton")
 */
class LoggingEngine implements RequestEngineInterface
{

    /**
     * @Flow\Inject
     * @var SystemLoggerInterface
     */
    protected $systemLogger;

    /**
     * @var string
     */
    protected $responseContent;

    /**
     * @param string $responseContent
     * @return void
     */
    public function setResponseContent($responseContent)
    {
        $this->responseContent = (string)$responseContent;
    }

    /**
     * @param string $url
     * @param array $getParameters
     * @return string
     */
    public function get($url, array $getParameters)
    {
        $this->systemLogger->log(
            sprintf('Send dummy GET request to "%s"', $url . '?' . http_build_query($getParameters)),
            LOG_DEBUG
        );

        return $this->responseContent;
    }

    /**
     * @param string $url
     * @param array $postParameters
     * @return string
     */
    public function post($url, array $postParameters)
    {
        $this->systemLogger->log(
            sprintf('Send dummy POST request to "%s" with the following POST parameters', $url . '?' . http_build_query($postParameters)),
            LOG_DEBUG
        );

        return $this->responseContent;
    }

}
