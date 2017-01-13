<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use PanelBundle\Form\NewsForm;
use InvitationBundle\Entity\News;

class NewsController extends Controller {
    const MODE_LIST = 'list';
    const MODE_CREATE = 'create';
    const MODE_EDIT = 'edit';

    public function indexAction($slug) {
        $Event = $this->getEvent($slug);
        
        $News = $this->getDoctrine()
            ->getRepository('InvitationBundle:News')
            ->findByEvent($Event, [
                'createdAt' => 'DESC',
            ]);
        
        $this->breadcrumb($Event, self::MODE_LIST);
        
        return $this->render('PanelBundle:News:index.html.twig', array(
            'NewsCollection' => $News,
            'Event' => $Event,
        ));
    }
    
    public function removeAction(Request $request, $slug, $newsSlug) {
        $Event = $this->getEvent($slug);
        
        $News = $this->getDoctrine()
            ->getRepository('InvitationBundle:News')
            ->findOneBy([
                'urlName' => $newsSlug,
                'event' => $Event,
            ]);
            
        if($News == null || $News->getEvent() !== $Event) {
            throw new AccessDeniedException('Access denied.');
        }
        
        $this->get('invitation.recorder')->start('news.remove')
            ->record('news.id', $News->getId())
            ->record('news.title', $News->getTitle())
            ->commit();
        
            $request->getSession()
                ->getFlashBag()
                ->add('success', $this->get('translator')->trans('news.remove.messages.success', [
                    '%title%' => $News->getTitle(),
                ]));
                
            $em = $this->getDoctrine()->getManager();
            $em->remove($News);
            $em->flush();
                
            return $this->redirectToRoute('panel_event_news', [
                'slug' => $slug,
            ]);
    }
    
    public function createAction(Request $request, $slug) {
        $Event = $this->getEvent($slug);
        
        $News = new News;
        
        $News->setEvent($Event);
        
        $form = $this->createForm(NewsForm::class, $News);
        
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $News = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($News);
            $em->flush();
            
            $this->get('invitation.recorder')->start('news.create')
                ->record('news.id', $News->getId())
                ->record('news.title', $News->getTitle())
                ->record('news.urlName', $News->getUrlName())
                ->record('news.published', $News->getPublished())
                ->record('news.publishAt', $News->getPublishAt())
                ->record('news.content', $News->getContent())
                ->record('news.shortContent', $News->getShortContent())
                ->commit();
            
            $request->getSession()
                ->getFlashBag()
                ->add('success', $this->get('translator')->trans('news.create.messages.success'));

            return $this->redirectToRoute('panel_event_news_edit', [
                'slug' => $slug,
                'newsSlug' => $News->getUrlName(),
            ]);
        }
        
        $this->breadcrumb($Event, self::MODE_CREATE);
        
        return $this->render('PanelBundle:News:create.html.twig', array(
            'Event' => $Event,
            'form' => $form->createView(),
        ));
    }
    
    public function editAction(Request $request, $slug, $newsSlug) {
        $Event = $this->getEvent($slug);
        
        $News = $this->getDoctrine()
            ->getRepository('InvitationBundle:News')
            ->findOneBy([
                'urlName' => $newsSlug,
                'event' => $Event,
            ]);
            
        if($News == null || $News->getEvent() !== $Event) {
            throw new AccessDeniedException('Access denied.');
        }
        
        $form = $this->createForm(NewsForm::class, $News);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $News = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($News);
            $em->flush();
            
            $request->getSession()
                ->getFlashBag()
                ->add('success', $this->get('translator')->trans('news.edit.messages.success'));
                
            $this->get('invitation.recorder')->start('news.update')
                ->record('news.id', $News->getId())
                ->record('news.title', $News->getTitle())
                ->record('news.urlName', $News->getUrlName())
                ->record('news.published', $News->getPublished())
                ->record('news.publishAt', $News->getPublishAt())
                ->record('news.content', $News->getContent())
                ->record('news.shortContent', $News->getShortContent())
                ->commit();

            return $this->redirectToRoute('panel_event_news_edit', [
                'slug' => $slug,
                'newsSlug' => $News->getUrlName(),
            ]);
        }
        
        $this->breadcrumb($Event, self::MODE_EDIT, $News);
        
        return $this->render('PanelBundle:News:edit.html.twig', array(
            'News' => $News,
            'Event' => $Event,
            'form' => $form->createView(),
        ));
    }
    
    protected function getEvent($slug) {
        $Event = $this->getDoctrine()
            ->getRepository('InvitationBundle:Event')
            ->findOneByUrlName($slug);
        $Event->loadPermissionSet($this->getUser());
        if(!$Event->checkPermission('event.view')) {
            throw new AccessDeniedException('Access denied.');
        }
        return $Event;
    }

    
    protected function breadcrumb($Event, $mode, $News = null) {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("breadcrumb.home", $this->get("router")->generate("panel_event_manager"));
        $breadcrumbs->addItem("literal", $this->get("router")->generate("panel_event_dashboard", array(
                    'slug' => $Event->getUrlName(),
                )), ['%var%' => $Event->getName()]);
        switch($mode) {
            case self::MODE_CREATE:
                $breadcrumbs->addItem("breadcrumb.event.news.list", $this->get("router")->generate("panel_event_news", [
                    'slug' => $Event->getUrlName(),
                ]));    
                $breadcrumbs->addItem("breadcrumb.event.news.create");
            break;
            case self::MODE_LIST:
                $breadcrumbs->addItem("breadcrumb.event.news.list");
            break;
            case self::MODE_EDIT:
                $breadcrumbs->addItem("breadcrumb.event.news.list", $this->get("router")->generate("panel_event_news", [
                    'slug' => $Event->getUrlName(),
                ]));    
                $breadcrumbs->addItem("literal", [], ['%var%' => $News->getTitle()]);
            break;
        }
    }

}
