<?php

namespace Application\BlogBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form as Field;

class Post extends Form
{
    public function configure()
    {
      $this->disableCsrfProtection();
      $this->add(new Field\TextField('title'));
      $this->add(new Field\TextField('slug'));
      $this->add(new Field\TextareaField('intro'));
      $this->add(new Field\TextareaField('body'));
    }
}
