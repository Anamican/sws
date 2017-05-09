<?php

namespace AppBundle\Api;
use Symfony\Component\HttpFoundation\Response;

/**
 * A wrapper for holding data to be used for a application/json response
 */
class ApiProblem
{
    const TYPE_VALIDATION_ERROR = 'validation_error';
    const TYPE_INVALID_REQUEST_BODY_FORMAT = 'invalid_body_format';
    const TYPE_NOT_FOUND = 'not_found';
    const TYPE_INVALID_TOKEN = 'invalid_token';
    const TYPE_INVALID_REQUEST = 'invalid_request';
    const TYPE_CONFLICTED_RESOURCE = 'conflicted_resource';

    private static $titles = array(
        self::TYPE_NOT_FOUND => 'Resource does not exists',
        self::TYPE_VALIDATION_ERROR => 'There was a validation error',
        self::TYPE_INVALID_REQUEST_BODY_FORMAT => 'Invalid JSON format sent',
        self::TYPE_INVALID_TOKEN => 'Invalid Access Token',
        self::TYPE_INVALID_REQUEST => 'Invalid request format sent. Check parameters.',
        self::TYPE_CONFLICTED_RESOURCE => 'Conflict in Resource'
    );

    private static $details = array(
        '401' => 'The access token provided is invalid',
        '404' => 'Resource requested could not be found or is unavailable',
        '409' => 'Resource already exists'
    );

    private $statusCode;

    private $type;

    private $title;

    private $extraData = array();

    public function __construct($statusCode, $type = null, $detail = null)
    {
        $this->statusCode = $statusCode;

        if ($type === null) {

            $type = 'about:blank';
            $title = isset(Response::$statusTexts[$statusCode])
                ? Response::$statusTexts[$statusCode]
                : 'Unknown status code';

        } else {
            if (!isset(self::$titles[$type])) {
                throw new \InvalidArgumentException('No title for type '.$type);
            }

            $title = self::$titles[$type];
        }


        $this->type = $type;
        $this->title = $title;

        if(!empty($detail)){
            $this->set('detail', $detail);
        }
        else if(isset(self::$details[$statusCode])){
            $this->set('detail', self::$details[$statusCode]);
        }
    }

    public function toArray()
    {
        return array(
            'errors' => array_merge(
                array(
                    'status' => $this->statusCode,
                    'type' => $this->type,
                    'title' => $this->title,
                ),
                $this->extraData
            )
        );
    }

    public function set($name, $value)
    {
        $this->extraData[$name] = $value;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getTitle()
    {
        return $this->title;
    }
}
