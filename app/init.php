<?php
require_once 'vendor/autoload.php';
    /*$es = new Elasticsearch\Client([
        'hosts' => ['127.0.0.1:9200'],
    ]);*/

use Elastic\Elasticsearch\ClientBuilder;
	$es = ClientBuilder::create()
->setHosts(['localhost:9200'])
->build();
?>
