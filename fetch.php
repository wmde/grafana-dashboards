<?php
/**
 * @author Addshore
 * Quick script for grabbing a list of dashboards
 */

$dashboards = array(
	'wikidata',
	'wikidata-edits',
	'wikidata-ci',
	'wikidata-tasks',
	'wikidata-api',
	'wikidata-api-wbgetclaims',
	'wikidata-dispatch',
	'wikidata-page-views-per-domain',
	'wikidata-social-followers',
	'wikidata-entity-usage',
	'wikidata-entity-usage-project',
	'wikidata-site-stats',
	'wikidata-top-page-views',
	'wikidata-query-service',
	'wikidata-datamodel',
	'wikidata-datamodel-terms',
	'wikidata-datamodel-statements',
	'wikidata-datamodel-references',
	'wikidata-kpis',
	'wikidata-special-entitydata',
	'wikidata-webpagetest',
);

foreach( $dashboards as $dashboard ) {
	echo "Getting dashboard $dashboard\n"; 
	$response = file_get_contents( "https://grafana.wikimedia.org/api/dashboards/db/$dashboard" );
	if( $response === false || $response === null ) {
		echo "Skipping $dashboard, something went wrong...\n";
		continue;
	}
	$data = json_decode( $response, true );
	$data = $data['dashboard'];
	$json = json_encode( $data, JSON_PRETTY_PRINT );
	file_put_contents( __DIR__ . '/' . $dashboard . ".json", $json );
}

echo "Done";
