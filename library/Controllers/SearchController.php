<?php namespace DanGreaves\Flickbook\Controllers;

use League\Url\Url;
use DanGreaves\Flickbook\Flickr\Exceptions\ApiException;

/**
 * Controller to manage search and detail actions.
 *
 * @author Dan Greaves <dan@dangreaves.com>
 */
class SearchController extends Controller
{
    /**
     * Return the search index page.
     * 
     * @return void
     */
    public function getIndex()
    {
        return $this->service->render(VIEWS_DIR . '/search/index.php');
    }

    /**
     * Fetch and return a results page for a query.
     * 
     * @return void
     */
    public function getResults()
    {
        $query = $this->request->param('query');

        if (! $query || ! trim($query)) {
            return $this->response->redirect('/');
        }

        $page = $this->request->param('page') ?: 1;

        $api = $this->app->container['flickr.api'];

        $results = $api->search($query, $page);

        $results->setPath('/search/' . $query);

        //Initialise escaper statics
        $this->app->container['escaper'];

        return $this->service->render(VIEWS_DIR . '/search/results.php', [
            'results' => $results,
            'query'   => $query,
            'page'    => $page
        ]);
    }

    /**
     * Fetch and return a detail page for a photo ID.
     * 
     * @return void
     */
    public function getDetail()
    {
        $id = $this->request->param('id');

        $query = $this->request->param('query');
        $page  = $this->request->param('page') ?: 1;

        $api = $this->app->container['flickr.api'];

        try {
            $photo = $api->getPhoto($id);
        } catch (ApiException $e) {
            return $this->response->redirect('/');
        }

        if ($query) {
            $back_url = Url::createFromUrl('http://flickbook.app/search');
            $back_url->getQuery()['query'] = $query;
            $back_url->getQuery()['page']  = $page;
            $back_url = $back_url->getRelativeUrl();
        } else {
            $back_url = null;
        }

        //Initialise escaper statics
        $this->app->container['escaper'];

        return $this->service->render(VIEWS_DIR . '/search/detail.php', [
            'photo'    => $photo,
            'back_url' => $back_url
        ]);
    }
}
