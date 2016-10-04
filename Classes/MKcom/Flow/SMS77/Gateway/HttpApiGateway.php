<?php
namespace MKcom\Flow\SMS77\Gateway;

/*
 * This file is part of the MKcom.Flow.SMS77 package.
 */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Object\ObjectManagerInterface;

/**
 * Class HttpApiGateway
 *
 * @package MKcom\Flow\SMS77
 *
 * @Flow\Scope("singleton")
 */
class HttpApiGateway extends \MKcom\SMS77\Gateway\HttpApiGateway
{

    /**
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @Flow\InjectConfiguration("settings")
     * @var array
     */
    protected $configuration;

    /**
     * @Flow\Inject
     * @var RequestEngineInterface
     */
    protected $requestEngine;

    /**
     * HttpApiGateway constructor.
     *
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @return void
     */
    public function initializeObject()
    {
        $this->configuration = array_merge(self::DEFAULT_CONFIGURATION, $this->configuration);

        foreach ($this->configuration as $key => $value) {
            if (property_exists(self::class, $key)) {
                $this->$key = $value;
            }
        }
    }

}
