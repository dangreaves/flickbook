<?php namespace DanGreaves\Flickbook\Controllers;

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

        $photo = $api->getPhoto($id);

        return $this->service->render(VIEWS_DIR . '/search/detail.php', [
            'photo' => $photo,
            'query' => $query,
            'page'  => $page
        ]);
    }
}
