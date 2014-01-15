<?php if(Facade_FlashMessage::hasMessages()) : ?>
  <div class="container">
    <?php foreach(Facade_FlashMessage::getMessages() as $message) : ?>
      <div class="alert alert-info fade in">
        <button type="button" class="close" data-dismiss="alert">&times;</button>

        <?= $message ?>
      </div>
    <?php endforeach ?>
  </div>
<?php endif ?>