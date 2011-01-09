<?php $view->extend('::layout.php') ?>
<?php $view['slots']->set('title', 'Index') ?>

<table>
  <tr>
    <th>
      Title
    </th>
    <th>
      Intro
    </th>
    <th>
      Actions
    </th>
  </tr>
  <?php foreach($posts as $post): ?>
  <tr>
    <td>
      <?php echo $post->getTitle(); ?>
    </td>
    <td>
      <?php echo $post->getIntro(); ?>
    </td>
    <td>
      <a onclick="if (confirm('Are you sure?') == false) return false;" href="<?php echo $view['router']->generate('post_delete', array('id' => $post->getId())) ?>">
        Delete
      </a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>

<div>
  <a href="<?php echo $view['router']->generate('post_create') ?>">
    Add
  </a>
</div>