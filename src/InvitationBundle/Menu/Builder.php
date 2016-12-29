<?php 
namespace InvitationBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface {
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options) {
        
        $menu = $factory->createItem('root');
		$menu->addChild('menu.logout', [
            'route' => 'invitation_logout', 
            'routeParameters' => ['slug' => $options['slug']]
        ]);
        return $menu;
    }
}