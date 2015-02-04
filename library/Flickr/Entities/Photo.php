<?php namespace DanGreaves\Flickbook\Flickr\Entities;

/**
 * Entity DTO for Flickr photos.
 *
 * @author Dan Greaves <dan@dangreaves.com>
 */
class Photo
{
    /**
     * Photo ID.
     * 
     * @var integer
     */
    protected $id;

    /**
     * Unique ID for photo owner.
     * 
     * @var string
     */
    protected $owner;

    /**
     * Secret token for the photo.
     * 
     * @var string
     */
    protected $secret;

    /**
     * Server on which photo is located.
     * 
     * @var integer
     */
    protected $server;

    /**
     * Server farm on which photo is located.
     * 
     * @var integer
     */
    protected $farm;

    /**
     * Title of the photo.
     * 
     * @var string
     */
    protected $title;

    /**
     * Description of the photo.
     * 
     * @var string
     */
    protected $description;

    /**
     * Return the photo ID.
     * 
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the photo ID.
     * 
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Return unique ID for photo owner.
     * 
     * @return string
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set unique ID for photo owner.
     * 
     * @param string $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Return secret token for the photo.
     * 
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Set secret token for the photo.
     * 
     * @param string $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * Return server on which photo is located.
     * 
     * @return integer
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * Set server on which photo is located.
     * 
     * @param integer $server
     */
    public function setServer($server)
    {
        $this->server = $server;

        return $this;
    }

    /**
     * Return server farm on which photo is located.
     * 
     * @return integer
     */
    public function getFarm()
    {
        return $this->farm;
    }

    /**
     * Set server farm on which photo is located.
     * 
     * @param integer $farm
     */
    public function setFarm($farm)
    {
        $this->farm = $farm;

        return $this;
    }

    /**
     * Return title of photo.
     *
     * @param  integer $limit Optional character limit
     * @return string
     */
    public function getTitle($limit = null)
    {
        if ($limit && strlen($this->title) > $limit) {
            return substr($this->title, 0, $limit) . '...';
        }

        return $this->title;
    }

    /**
     * Set title of photo.
     * 
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Return description of photo.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description of photo.
     * 
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Generate a source URL for this photo.
     * 
     * @param string $size The Flickr defined size required
     * @see   https://www.flickr.com/services/api/misc.urls.html
     */
    public function getUrl($size = 'z')
    {
        return "https://farm{$this->farm}.staticflickr.com/{$this->server}/{$this->id}_{$this->secret}_{$size}.jpg";
    }
}
