<?php
namespace MKcom\Flow\SMS77\Gateway\RequestEngine;

/*
 * This file is part of the MKcom.Flow.SMS77 package.
 */

use TYPO3\Flow\Annotations as Flow;
use MKcom\Flow\SMS77\Gateway\RequestEngineInterface;
use TYPO3\Flow\Http\Request;
use TYPO3\Flow\Http\Response;
use TYPO3\Flow\Http\Uri;
use TYPO3\Flow\Object\ObjectManagerInterface;

/**
 * Class FlowRequestEngine
 *
 * @package MKcom\Flow\SMS77\Gateway\RequestEngine
 *
 * @Flow\Scope("singleton")
 */
class FlowRequestEngine implements RequestEngineInterface
{

    /**
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @Flow\Inject
     * @var \TYPO3\Flow\Http\Client\RequestEngineInterface
     */
    protected $flowRequestEngine;

    /**
     * FlowRequestEngine constructor.
     *
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param string $url
     * @param array $getParameters
     * @return mixed
     */
    public function get($url, array $getParameters)
    {
        $uri = $this->objectManager->get(Uri::class, $url);
        $uri->setQuery(http_build_query($getParameters));

        $request = Request::create($uri);

        /** @var Response $response */
        $response = $this->flowRequestEngine->sendRequest($request);

        return $response->getContent();
    }

    /**
     * @param string $url
     * @param array $postParameters
     * @return mixed
     */
    public function post($url, array $postParameters)
    {
        $uri = $this->objectManager->get(Uri::class, $url);

        $request = Request::create($uri, 'POST', $postParameters);

        /** @var Response $response */
        $response = $this->flowRequestEngine->sendRequest($request);

        return $response->getContent();
    }

}
