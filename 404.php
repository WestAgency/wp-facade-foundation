<?php

header('HTTP/1.0 404 Not Found', true, 404);
Timber::render('404.twig');