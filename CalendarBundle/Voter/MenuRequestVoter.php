<?php

namespace EllisApps\CalendarBundle\Voter;

use JMS\DiExtraBundle\Annotation as DI;
use Knp\Menu\ItemInterface;
use Knp\Menu\Matcher\Voter\VoterInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @DI\Service("ellisapps_calendar.menu_request_voter")
 * @DI\Tag("knp_menu.voter")
 */
class MenuRequestVoter implements VoterInterface
{
    private $request;

    /**
     * @DI\InjectParams({
     *     "request" = @DI\Inject("request", strict=false)
     * })
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Checks whether an item is current.
     *
     * If the voter is not able to determine a result,
     * it should return null to let other voters do the job.
     *
     * @param  ItemInterface $item
     * @return boolean|null
     */
    public function matchItem(ItemInterface $item)
    {
        if ($item->getUri() === $this->request->getRequestUri()) {
            // URL's completely match
            return true;
        } elseif ($item->getUri() !== $this->request->getBaseUrl().'/' && (substr($this->request->getRequestUri(), 0, strlen($item->getUri())) === $item->getUri())) {
            // URL isn't just "/" and the first part of the URL match
            return true;
        }

        return null;
    }
}
