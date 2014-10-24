<?php

namespace Contact\Bundle\NotificationBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

class NotificationExtension extends \Twig_Extension
{
    /**
     * @var Service Container
     */
    protected $container;

    /**
     * @var Notify Service
     */
    protected $notify;

    /**
     * @param Container $container Service container.
     */
    public function __construct(ContainerInterface $container = null)
    {
        $this->container = $container;
        $this->notify = $container->get('contact.notify');
    }

    public function getFunctions()
    {
        return array(
            'show_notifications' => new \Twig_Function_Method($this, 'renderAll', array('is_safe' => array('html'))),
            'show_notification' => new \Twig_Function_Method($this, 'render', array('is_safe' => array('html'))),
        );
    }

    /**
     * Render all notifications
     * 
     * @param  boolean $container
     * @return mixed
     */
    public function renderAll($container = false)
    {
        $allNotifications = $this->notify->all();

        if (count($allNotifications)) {
            return $this->container->get('templating')
                ->render(
                    'ContactNotificationBundle:Notification:notifications.html.twig',
                    compact('allNotifications', 'container')
                );
        }

        return null;
    }

    /**
     * Render a single notification
     * 
     * @param  string  $name Notification name.
     * @param  $container
     * @return mixed
     */
    public function render($name, $container = false)
    {
        if (!$this->notify->has($name)) {
            return false;
        }

        $notifications = $this->notify->get($name);

        if (count($notifications)) {
            return $this->container->get('templating')
                ->render(
                    'ContactNotificationBundle:Notification:notification.html.twig',
                    compact('notifications', 'container')
                );
        }

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'contact_notification_extension';
    }
}
