<?php 
namespace PanelBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root');
		$menu->addChild('menu.myAccount', array('route' => 'panel_my_account'));
		$menu->addChild('menu.logout', array('route' => 'fos_user_security_logout'));

        return $menu;
    }
    
    public function eventMenu (FactoryInterface $factory, array $options) {
        $Event = $options['Event'];
        
        $menu = $factory->createItem('root', [
            'childrenAttributes' => [
                'class' => 'sidebar-nav',
                'id' => 'sidemenu',
            ]
        ]);
        
		$menu->addChild('eventMenu.dashboard', [
            'route' => 'panel_event_dashboard',
            'routeParameters' => ['slug' => $Event->getUrlName()],
        ])->setAttribute('icon', 'fa-tachometer');
        
		$menu->addChild('eventMenu.invitations', [
            'route' => 'panel_invitations_manager',
            'routeParameters' => ['slug' => $Event->getUrlName()],
        ])->setAttribute('icon', 'fa-envelope-open-o');
        
		$menu->addChild('eventMenu.news', [
            'route' => 'panel_event_news',
            'routeParameters' => ['slug' => $Event->getUrlName()],
        ])->setAttribute('icon', 'fa-newspaper-o');
        
        $report = $menu->addChild('eventMenu.report.name', [
            'uri' => '#report-submenu',
            'childrenAttributes'    => [
                'class' => 'panel-collapse collapse panel-switch',
                'role' => 'menu',
                'id' => 'report-submenu',
            ],
        ])
        ->setAttribute('icon', 'fa-file-text-o');
        
        $report->addChild('eventMenu.report.person', [
            'uri' => '#',
        ]);
        $report->addChild('eventMenu.report.invitation', [
            'uri' => '#',
        ]);
        $report->addChild('eventMenu.report.changelog', [
            'uri' => '#',
        ]);
        
		$menu->addChild('eventMenu.generator', [
            'route' => 'panel_event_generator',
            'routeParameters' => ['slug' => $Event->getUrlName()],
        ])->setAttribute('icon', 'fa-download');
        
		$menu->addChild('eventMenu.config', [
            'route' => 'panel_event_config',
            'routeParameters' => ['slug' => $Event->getUrlName()],
        ])->setAttribute('icon', 'fa-cog');
        
        return $menu;
    }
}