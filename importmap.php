<?php

/**
 * Returns the importmap for this application.
 *
 * - "path" is a path inside the asset mapper system. Use the
 *     "debug:asset-map" command to see the full list of paths.
 *
 * - "entrypoint" (JavaScript only) set to true for any module that will
 *     be used as an "entrypoint" (and passed to the importmap() Twig function).
 *
 * The "importmap:require" command can be used to add new entries to this file.
 */
return [
    'app' => [
        'path' => './assets/app.js',
        'entrypoint' => true
    ],
    'vis-timeline' => [
        'version' => '7.7.3',
    ],
    'vis-data' => [
        'version' => '7.1.9',
    ],
    'vis-timeline/dist/vis-timeline-graph2d.css' => [
        'version' => '7.7.3',
        'type' => 'css'
    ],
    '@symfony/stimulus-bundle' => [
        'path' => './vendor/symfony/stimulus-bundle/assets/dist/loader.js',
    ],
    '@hotwired/stimulus' => [
        'version' => '3.2.2',
    ],
    '@hotwired/turbo' => [
        'version' => '8.0.12',
    ],
    'typed.js' => [
        'version' => '2.1.0',
    ],
    'chart.js' => [
        'version' => '4.4.1',
    ],
    '@kurkle/color' => [
        'version' => '0.3.2',
    ],
    'date-fns' => [
        'version' => '4.1.0',
    ],
    'axentix' => [
        'version' => '2.4.1',
    ],
    'axentix/dist/axentix.min.css' => [
        'version' => '2.4.1',
        'type' => 'css',
    ],
    'vis-timeline' => [
        'version' => '7.7.3',
    ],
    'moment' => [
        'version' => '2.29.4',
    ],
    'vis-data/peer/esm/vis-data.js' => [
        'version' => '7.1.9',
    ],
    'vis-data' => [
        'version' => '7.1.9',
    ],
];