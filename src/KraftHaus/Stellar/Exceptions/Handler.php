<?php

namespace KraftHaus\Stellar\Exceptions;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exception\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends \Illuminate\Foundation\Exceptions\Handler
{

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request $request
     * @param  Exception $e
     *
     * @return Response
     */
    public function render($request, Exception $e)
    {
        if (config('app.debug') !== true && context()->isFrontend()) {
            return $this->renderFrontendException($e);
        }

        return parent::render($request, $e);
    }

    /**
     * @param  Exception  $e
     *
     * @return Response
     */
    protected function renderFrontendException(Exception $e)
    {
        $headers = $this->getHeaders($e);
        $status = $this->getStatusCode($e);

        return theme()->response('errors.' . $status, ['exception' => $e], $status, $headers);
    }

    /**
     * Get the request status code.
     *
     * @param  Exception  $e
     *
     * @return int
     */
    protected function getStatusCode(Exception $e)
    {
        if (method_exists($e, 'getStatusCode')) {
            return $e->getStatusCode();
        }

        return 500;
    }

    /**
     * Get the request headers.
     *
     * @param  Exception  $e
     *
     * @return array
     */
    protected function getHeaders(Exception $e)
    {
        if (method_exists($e, 'getHeaders')) {
            return $e->getHeaders();
        }

        return [];
    }
}
