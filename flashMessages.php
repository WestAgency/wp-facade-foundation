<?php

$data = Timber::get_context();
$data['FlashMessage'] = new Facade_FlashMessage;
Timber::render('partial/flashMessages.twig', $data);