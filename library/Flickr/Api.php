<?php namespace DanGreaves\Flickbook\Flickr;

use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use DanGreaves\Flickbook\Flickr\Entities\Photo;
use DanGreaves\Flickbook\Flickr\Exceptions\ApiException;
use DanGreaves\Flickbook\Flickr\Exceptions\PhotoNotFoundException;

/**
 * Abstraction for the Flickr API.
 *
 * @author Dan Greaves <dan@dangreaves.com>
 */
class Api
{
    /**
     * API key for authenticated access.
     * 
     * @var string
     */
    protected $key;

    /**
     * API secret for authenticated access.
     * 
     * @var string
     */
    protected $secret;

    /**
     * Endpoint for API calls.
     * 
     * @var string
     */
    protected $endpoint = 'https://api.flickr.com/services/rest';

    /**
     * Guzzle client for HTTP requests.
     * 
     * @var GuzzleHttp\Client
     */
    protected $client;

    /**
     * Construct a new API instance.
     * 
     * @param string            $key      API key for authenticated access
     * @param string            $secret   API secret for authenticated access
     * @param string            $endpoint Optional endpoint for API calls
     * @param GuzzleHttp\Client $client   Optional Guzzle client for HTTP requests
     */
    public function __construct($key, $secret, $endpoint = null, Client $client = null)
    {
        $this->key = $key;
        $this->secret = $secret;

        if ($endpoint) {
            $this->endpoint = $endpoint;
        }

        if ($client) {
            $this->client = $client;
        } else {
            $this->client = new Client(['base_url' => $this->endpoint]);
        }
    }

    /**
     * Search the Flickr library for a query term.
     * 
     * @param  string  $query    Requested query term
     * @param  integer $page     Current results page
     * @param  integer $per_page Results per page
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function search($query, $page = 1, $per_page = 24)
    {
        $response = $this->request('flickr.photos.search', [
            'text'     => $query,
            'per_page' => $per_page,
            'page'     => $page
        ]);

        $collection = new Collection;

        foreach ($response->photos->photo as $p) {
            $photo = (new Photo)
                ->setId((int) $p->id)
                ->setOwner((string) $p->owner)
                ->setSecret((string) $p->secret)
                ->setServer((int) $p->server)
                ->setFarm((int) $p->farm)
                ->setTitle((string) $p->title);

            $collection->push($photo);
        }

        $paginator = new LengthAwarePaginator(
            $collection,
            $response->photos->total,
            $response->photos->perpage,
            $page
        );

        return $paginator;
    }

    /**
     * Return a photo instance by ID.
     * 
     * @param  integer $id
     * @return DanGreaves\Flickbook\Flickr\Entities\Photo
     */
    public function getPhoto($id)
    {
        try {
            $response = $this->request('flickr.photos.getInfo', [
                'photo_id' => $id
            ]);
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 1:
                    throw new PhotoNotFoundException($e->getMessage(), $e->getCode());
                    break;
                default:
                    throw $e;
                    break;
            }
        }

        $p = $response->photo;

        $photo = (new Photo)
            ->setId((int) $p->id)
            ->setOwner((string) $p->owner->nsid)
            ->setSecret((string) $p->secret)
            ->setServer((int) $p->server)
            ->setFarm((int) $p->farm)
            ->setTitle((string) $p->title->_content)
            ->setDescription((string) $p->description->_content);

        return $photo;
    }

    /**
     * Dispatch an authenticated API request and return the result.
     * 
     * @param  string $method  Requested Flickr method.
     * @param  array  $payload Optional extra parameter payload
     * @return array
     */
    protected function request($method, $payload = [])
    {
        $query = [
            'method' => $method,
            'api_key' => $this->key,
            'format' => 'json',
            'nojsoncallback' => 1
        ];

        if (is_array($payload)) {
            $query += $payload;
        }

        $response = $this->client->get('', [
            'query' => $query
        ]);

        $json = $response->json(['object' => true]);

        if ('ok' != $json->stat) {
            throw new ApiException($json->message, $json->code);
        }

        return $json;
    }
}
