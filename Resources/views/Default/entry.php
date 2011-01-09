<?php $view->extend('::layout.php') ?>
<?php $view['slots']->set('title', 'Homepage') ?>

<form method="POST" action="<?php echo $view['router']->generate('posts') ?>">
  <?php echo $view['form']->render($form) ?>
  <input type="submit" />
</form>

<div>
  <a href="<?php echo $view['router']->generate('posts') ?>">
    Back
  </a>
</div>