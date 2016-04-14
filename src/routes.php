<?php
// Routes

$app->get('/', function ($request, $response, $args) {
	$data = array(
		'results' => array(),
		'film1' => '',
		'film2' => ''
	);
    return $this->renderer->render($response, 'index.phtml', $data);
});

$app->post('/search', function ($request, $response, $args) {
	$filmSearch = new FilmSearch;
	$post = $request->getParsedBody();
	$results = $filmSearch->search($post['film1'], $post['film2']);
	$data = array(
		'results' => $results,
		'film1' => $post['film1'],
		'film2' => $post['film2']
	);
	return $this->renderer->render($response, 'index.phtml', $data);
});
