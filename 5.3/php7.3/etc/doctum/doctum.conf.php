<?php

use Doctum\Doctum;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

function env($var, $default=false)
{
  $env = getenv($var);
  return $env ? $env : $default;
}

$srcdir = env('DOCTUM_SOURCE_DIR', 'src');
$builddir = env('DOCTUM_BUILD_DIR', 'docs/build/html/api');
$cachedir = env('DOCTUM_CACHE_DIR', 'docs/cache/html/api');
$title = env('DOCTUM_PROJECT_TITLE', 'API Documentation');
$theme = env('DOCTUM_THEME', 'default');


$iterator = Finder::create()
  ->files()
  ->name("*.php")
  ->exclude("tests")
  ->exclude("resources")
  ->exclude("behat")
  ->exclude("vendor")
  ->in(explode(':', $srcdir));

return new Doctum($iterator, array(
  'theme'     => $theme,
  'title'     => $title,
  'build_dir' => $builddir,
  'cache_dir' => $cachedir,
));
