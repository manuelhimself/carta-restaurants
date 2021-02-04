<?php

require 'Router.php';

require 'Request.php';


require Router::load('routes.php')->direct(Request::uri());