<?php

$data = Timber::get_context();
$data['FlashMessage'] = new Facade_FlashMessage;
Timber::render('partial/flash-messages.twig', $data);