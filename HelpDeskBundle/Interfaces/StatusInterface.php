<?php

namespace EllisApps\HelpDeskBundle\Interfaces;

interface StatusInterface
{
    const CREATED  = 'created';
    const FIXED    = 'fixed';
    const NOISSUE  = 'no issue';
    const INREVIEW = 'in review';
    const CLOSED   = 'closed';
    const COMPLETE = 'complete';
}
