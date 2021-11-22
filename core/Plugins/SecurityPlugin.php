<?php declare(strict_types=1);

namespace Ocms\Core\Plugins;

use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Component;
use Phalcon\Acl\Role;
use Phalcon\Acl\Enum;
use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;

/**
 * SecurityPlugin Plugin Class.
 *
 * This is the security plugin which controls that users only have access to the modules they're assigned to
 *
 * @package core
 * @access public
 * @since 10.11.2021
 * @version 0.0.0 21.11.20219
 * @author Oleg Ivanchenko <oleg@ivanchenko.ch>
 * @copyright Copyright (C) 2021, OCMS
 */
class SecurityPlugin extends Injectable
{
    /**
     * This action is executed before execute any action in the application
     *
     * @param Event $event
     * @param Dispatcher $dispatcher
     * @return bool
     */
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher): bool
	{
		if (isset($this->session)) {
			$auth = $this->session->get('auth');
		} else {
			$auth = null;
		}

        if (!$auth) {
            $role = 'Guests';
        } else {
            $role = 'Users';
        }

        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();

        $acl = $this->getAcl();

        if (!$acl->isComponent($controller)) {
            $dispatcher->forward([
                'controller' => 'errors',
                'action'     => 'show404'
            ]);

            return false;
        }

        $allowed = $acl->isAllowed($role, $controller, $action);
        if (!$allowed) {
            $dispatcher->forward([
                'controller' => 'errors',
                'action'     => 'show401'
            ]);

            $this->session->destroy();

            return false;
        }

        return true;
    }

    /**
     * Returns an existing or new access control list
     *
     * @returns AclList
     */
    protected function getAcl(): AclList
    {
        if (isset($this->persistent->acl)) {
            return $this->persistent->acl;
        }

        $acl = new AclList();
        $acl->setDefaultAction(Enum::DENY);

        // Register roles
        $roles = [
	        'admins'  => new Role(
		        'Admins',
		        'Site administrators.'
	        ),
            'users'  => new Role(
                'Users',
                'Member privileges, granted after sign in.'
            ),
            'guests' => new Role(
                'Guests',
                'Anyone browsing the site who is not signed in is considered to be a "Guest".'
            )
        ];

        foreach ($roles as $role) {
            $acl->addRole($role);
        }

        //Private area resources
        $privateResources = [
	        'user'    => ['logout']
        ];
        foreach ($privateResources as $resource => $actions) {
            $acl->addComponent(new Component($resource), $actions);
        }

        //Public area resources
        $publicResources = [
            'index'      => ['index'],
            'register'   => ['index'],
            'errors'     => ['show401', 'show404', 'show500'],
            'user'       => ['index', 'register', 'login'],
	        'node'       => ['view']
        ];
        foreach ($publicResources as $resource => $actions) {
            $acl->addComponent(new Component($resource), $actions);
        }

        //Grants access to public areas to both users and guests
        foreach ($roles as $role) {
            foreach ($publicResources as $resource => $actions) {
                foreach ($actions as $action) {
                    $acl->allow($role->getName(), $resource, $action);
                }
            }
        }

        //Grants access to private area to Admins and Users roles
        foreach ($privateResources as $resource => $actions) {
            foreach ($actions as $action) {
	            $acl->allow('Admins', $resource, $action);
                $acl->allow('Users', $resource, $action);
            }
        }

        //The acl is stored in session, APC would be useful here too
        $this->persistent->acl = $acl;

        return $acl;
    }
}
