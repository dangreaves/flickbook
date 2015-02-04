<?php namespace DanGreaves\Flickbook\Controllers;

use Klein\Request;
use Klein\Response;
use Klein\ServiceProvider;
use Klein\App;

/**
 * Base controller instantiated with Klein resources.
 *
 * @author Dan Greaves <dan@dangreaves.com>
 */
abstract class Controller
{
    /**
     * Make a new controller instance.
     * 
     * @param  Klein\Request         $request
     * @param  Klein\Response        $response
     * @param  Klein\ServiceProvider $service
     * @param  Klein\App             $app
     * @return DanGreaves\Flickbook\Controllers\Controller
     */
    public static function make(
        Request $request,
        Response $response,
        ServiceProvider $service,
        App $app
    ) {
        return new static($request, $response, $service, $app);
    }

    /**
     * A Klein request object.
     * 
     * @var Klein\Request
     */
    protected $request;

    /**
     * A Klein response object.
     * 
     * @var Klein\Response
     */
    protected $response;

    /**
     * A Klein service provider instance.
     * 
     * @var Klein\ServiceProvider
     */
    protected $service;

    /**
     * The Klein app instance.
     * 
     * @var Klein\App
     */
    protected $app;

    /**
     * Construct a new controller instance.
     * 
     * @param  Klein\Request         $request
     * @param  Klein\Response        $response
     * @param  Klein\ServiceProvider $service
     * @param  Klein\App             $app
     * @return void
     */
    public function __construct(
        Request $request,
        Response $response,
        ServiceProvider $service,
        App $app
    ) {
        $this->request  = $request;
        $this->response = $response;
        $this->service  = $service;
        $this->app      = $app;
    }
}
