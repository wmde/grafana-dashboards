<?php
/**
 * @author Addshore
 * Quick script for grabbing a list of dashboards
 */

$dashboards = array(
	// Wikidata related
	'article-placeholder',
	'wikidata',
	'wikidata-api',
	'wikibase-api-error-rate',
	'wikidata-api-wbsetclaim',
	'wikibase-api-wbgetentities',
	'wikidata-ci',
	'wikidata-datamodel',
	'wikidata-datamodel-terms',
	'wikidata-datamodel-statements',
	'wikidata-datamodel-references',
	'wikidata-dispatch',
	'wikidata-dispatch-script',
	'wikidata-dump-downloads',
	'wikidata-edits',
	'wikidata-entity-usage',
	'wikidata-entity-usage-project',
	'wikidata-kpis',
	'wikidata-page-views-per-domain',
	'wikidata-quality',
	'wikidata-query-service',
	'wikidata-query-service-ui',
	'wikidata-site-stats',
	'wikidata-social-followers',
	'wikidata-special-entitydata',
	'wikidata-tasks',
	'wikidata-top-page-views',
	'wikidata-webpagetest',
	'wikipageupdater-calls',
	// TCB related
	'team-tcb',
	'collection_use',
	'echo-mention-errors',
	'echo-mention-status-notifications',
	'mediawiki-catwatch-feature',
	'mediawiki-edit-conflicts',
	'mediawiki-electronpdfservice',
	'mediawiki-watcheditemstore',
	'mediawiki-revisionslider',
	'mediawiki-twocolconflict',
	// Misc?
	'betafeatures',
);

if ( array_key_exists( 1, $argv ) ) {
	$requestedDashboard = $argv[1];
	if( in_array( $requestedDashboard, $dashboards ) ) {
		$dashboards = array( $requestedDashboard );
	} else {
		echo "Requested dashboard '$requestedDashboard' was not in the dashboard list\n";
		exit;
	}
}

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
exit;

