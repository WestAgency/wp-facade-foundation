<?php header('HTTP/1.0 404 Not Found', true, 404) ?>

<?php get_header() ?>

<?php get_header('masthead') ?>

<?php get_header('nav') ?>

<div class="container">
  <div class="row">
    <div class="col-md-12 animated fadeIn">
      <article>
        <h1><?= __('404') ?></h1>

        <h2>
          <?= __('The page you are looking for doesn\'t exist..', 'w&c') ?>
        </h2>
      </article>
    </div>
  </div>
</div>

<?php get_footer() ?>