<?php

class Menu extends CMenu
{
    /**
     * Initializes the menu widget.
     * This method mainly normalizes the {@link items} property.
     * If this method is overridden, make sure the parent implementation is invoked.
     */
    public function init()
    {
        $route = $this->getController()->getRoute();
        $this->items = $this->normalizeItems($this->items, $route, $hasActiveChild);
    }
}