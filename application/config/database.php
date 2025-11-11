<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
    'dsn'       => '',
    'hostname'  => 'localhost',                 // Hostinger host
    'username'  => 'u152458561_black',          // Hostinger DB username
    'password'  => 'Sephor@5',                  // Hostinger DB password
    'database'  => 'u152458561_hrsystemci',     // Hostinger DB name
    'dbdriver'  => 'mysqli',
    'dbprefix'  => '',
    'pconnect'  => FALSE,
    'db_debug'  => (ENVIRONMENT !== 'production'),
    'cache_on'  => FALSE,
    'cachedir'  => '',
    'char_set'  => 'utf8',
    'dbcollat'  => 'utf8_general_ci',
    'swap_pre'  => '',
    'encrypt'   => FALSE,
    'compress'  => FALSE,
    'stricton'  => FALSE,
    'failover'  => array(),
    'save_queries' => TRUE
);

/* End of file database.php */
/* Location: ./application/config/database.php */

