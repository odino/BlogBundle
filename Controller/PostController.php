<?php

namespace Application\BlogBundle\Controller;

use Application\BlogBundle\Form\Post as PostForm;
use Application\BlogBundle\Entity\Post as Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostController extends Controller
{
    public function postsAction()
    {
        $request  = $this->get('request');
        $method   = strtolower($request->getMethod()) . 'Post';

        return $this->$method();
    }

    public function addAction()
    {
        return $this->renderEntry($this->getForm());
    }

    public function postAction($id)
    {
        return $this->getPost($id);
    }

    public function postDeleteAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $post   = $em->getRepository("Application\BlogBundle\Entity\Post")
                     ->findOneBy(array('id' => $id));
        $em->remove($post);
        $em->flush();

        return $this->redirect($this->generateUrl('posts'));
    }

    protected function forward404($template = 'BlogBundle:Default:404.php', $parameters = array())
    {
        $response = $this->get('response');
        $response->setStatusCode(404);

        return $this->render($template, $parameters, $response);
    }

    protected function getForm(Post $post = null)
    {
        if ($post == null)  {
          $post = new Post;
        }

        return new PostForm('post', $post, $this->get('validator'));
    }

    protected function getPost($id = null)
    {
        $em = $this->get('doctrine.orm.entity_manager');

        if (!$id) {
            $posts = $em->getRepository("Application\BlogBundle\Entity\Post")->findAll();

            return $this->render('BlogBundle:Default:index.php', array(
                'posts' => $posts,
            )); 
        }

        $post   = $em->getRepository("Application\BlogBundle\Entity\Post")
                     ->findOneBy(array('id' => $id));

        if (!$post) {
            return $this->forward404();
        }


        return $this->renderEntry($this->getForm($post));
    }

    protected function postPost()
    {
        $form = $this->getForm();

        if ('POST' === $this->get('request')->getMethod()) {
            $form->bind($this->get('request')->request->get('post'));

            if ($form->isValid()) {
                $em = $this->get('doctrine.orm.entity_manager');
                $post = $form->getData();
                $em->persist($post);
                $em->flush();

                return $this->redirect($this->generateUrl('post', array('id' => $post->getId())));
            }
        }

        return $this->renderEntry($form);
    }

    protected function renderEntry(PostForm $form)
    {
        return $this->render('BlogBundle:Default:entry.php', array(
            'form' => $form,
        ));
    }
}