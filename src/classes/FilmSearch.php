<?php

use GuzzleHttp\Client;

class FilmSearch
{

	private $client;

	/**
	 * Construct class and set Guzzle client.
	 * 
	 * @return void
	 */
	public function __construct()
	{
		$this->client = new Client([
			'base_uri' => 'http://www.omdbapi.com'
		]);
	}

	/**
	 * Find actors in two films and return intersect.
	 * 
	 * @param string $title1 
	 * @param string $title2 
	 * @return array
	 */
	public function search($title1, $title2)
	{
		$actors1 = $this->get_actors($title1);
		$actors2 = $this->get_actors($title2);
		return array(
			'actors1' => $actors1,
			'actors2' => $actors2,
			'intersect' => $this->get_intersect($actors1, $actors2)
		);
	}

	/**
	 * Get the intersect of two arrays of actors.
	 * 
	 * @param array $actors1 
	 * @param array $actors2 
	 * @return array
	 */
	public function get_intersect($actors1, $actors2)
	{
		return array_intersect($actors1, $actors2);
	}

	/**
	 * Return the actors of a given film title.
	 * 
	 * @param string $title 
	 * @return array
	 */
	public function get_actors($title)
	{
		$film_data = $this->get_film_data($title);
		$actors_arr = explode(',', $film_data->Actors);
		$return_arr = array();
		foreach ($actors_arr as $actor)
		{
			$return_arr[] = trim($actor);
		}
		return $return_arr;
	}

	/**
	 * Guzzle film data from OMDb API.
	 * 
	 * @param string $title 
	 * @return json
	 */
	public function get_film_data($title)
	{
		$res = $this->client->get('http://www.omdbapi.com?t=' . $title);
		return json_decode($res->getBody());
	}
}