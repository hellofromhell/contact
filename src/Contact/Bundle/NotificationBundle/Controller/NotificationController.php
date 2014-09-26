<?php

namespace Contact\Bundle\NotificationBundle\Controller;

class NotificationController
{
    private $defaults = array(
        'type' => 'flash',
    );

    private $flashes = array();

    private $session;

    public function __construct(\Symfony\Component\HttpFoundation\Session\Session $session)
    {
        $this->session = $session;
    }

    public function add($name, array $arguments = array())
    {
        $arguments += $this->defaults;

        if ($arguments['type'] === 'flash') {
            $this->session->getFlashBag()->add($name, $arguments);
        } elseif ($arguments['type'] === 'instant') {
            if (!isset($this->flashes[$name])) {
                $this->flashes[$name] = array();
            }

            $this->flashes[$name][] = $arguments;
        }
    }

    public function has($name)
    {
        if ($this->session->getFlashBag()->has($name)) {
            return true;
        } else {
            return isset($this->flashes[$name]);
        }
    }

    public function get($name)
    {
        $flashBag = $this->session->getFlashBag();

        if ($flashBag->has($name) && isset($this->flashes[$name])) {
            return array_merge_recursive($flashBag->get($name), $this->flashes[$name]);
        } elseif ($flashBag->has($name)) {
            return $flashBag->get($name);
        } else {
            return $this->flashes[$name];
        }
    }

    public function all()
    {
        return array_merge_recursive($this->session->getFlashBag()->all(), $this->flashes);
    }
}
