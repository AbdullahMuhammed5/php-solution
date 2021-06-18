<?php


namespace App;

class Route
{
    /**
     * The request we're working with.
     *
     * @var string
     */
    public $request;

    /**
     * The $routes array will contain all URI's and callbacks.
     *
     * @var array
     */
    public $routes = [];

    /**
     *
     * @param array $request
     */
    public function __construct(array $request)
    {
        $this->request = basename($request['REQUEST_URI']);
    }

    /**
     * Assign routes to callbacks.
     *
     * @param string $uri
     * @param \Closure $fn
     */
    public function addRoute(string $uri, \Closure $fn)
    {
        $this->routes[$uri] = $fn;
        $this->fireCallback();
    }

    /**
     * Determine is the requested route exists in our
     * routes array.
     *
     * @param  string  $uri
     * @return boolean
     */
    public function hasRoute(string $uri) : bool
    {
        return array_key_exists($uri, $this->routes);
    }

    /**
     * Run the router.
     *
     * @return mixed
     */
    public function fireCallback()
    {
        if($this->hasRoute($this->request)) {
            $this->routes[$this->request]->call($this);
        }
    }
}