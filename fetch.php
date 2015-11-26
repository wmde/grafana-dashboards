<?php
/**
 * @author Addshore
 * Quick script for grabbing a list of dashboards
 */

$dashboards = array(
	'wikidata',
	'wikidata-edits',
	'wikidata-api',
	'wikidata-api-wbgetclaims',
	'wikidata-dispatch',
	'wikidata-page-views-per-domain',
	'wikidata-social-followers',
	'wikidata-entity-usage',
	'wikidata-site-stats',
	'wikidata-top-page-views',
	'wikidata-query-service',
	'wikidata-datamodel',
	'wikidata-datamodel-languages',
);

foreach( $dashboards as $dashboard ) {
	echo "Getting dashboard $dashboard\n"; 
	$response = file_get_contents( "https://grafana.wikimedia.org/api/dashboards/db/$dashboard" );
	$data = json_decode( $response, true );
	$data = $data['dashboard'];
	$json = json_encode( $data, JSON_PRETTY_PRINT );
	file_put_contents( __DIR__ . '/' . $dashboard . ".json", $json );
}

echo "Done";
