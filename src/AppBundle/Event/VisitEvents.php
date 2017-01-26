<?php
/**
 * Created by PhpStorm.
 * User: wamobi9
 * Date: 26/01/17
 * Time: 09:29
 */

namespace AppBundle\Event;


class VisitEvents
{
    const CONTACT='App.events.visit'; // le nom de l'evenement  comme le  KernelEvents::REQUEST
    const PRODUCT='App.events.product'; // le nom de l'evenement                   ||
                                                                      // VisitEvents::App.events.visit
}