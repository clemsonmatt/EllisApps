<?php

namespace EllisApps\HelpDeskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use EllisApps\HelpDeskBundle\Entity\Ticket;
use EllisApps\HelpDeskBundle\Entity\StatusHistory;
use EllisApps\HelpDeskBundle\Interfaces\StatusInterface;

class TicketController extends Controller
{
    /**
     * @Route("/", name="ellisapps_helpdesk_ticket_index")
     */
    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('EllisAppsHelpDeskBundle:Ticket');
        $tickets    = $repository->createQueryBuilder('t')
            ->join('EllisAppsHelpDeskBundle:StatusHistory', 'sh', 'WITH', 't.currentStatus = sh')
            ->where('sh.status NOT IN (:status)')
            ->setParameter('status', ['in review', 'closed', 'complete'])
            ->getQuery()
            ->getResult();

        return $this->render('EllisAppsHelpDeskBundle:Ticket:index.html.twig', [
            'tickets' => $tickets,
        ]);
    }

    /**
     * @Route("/resolved", name="ellisapps_helpdesk_ticket_resolved")
     */
    public function resolvedAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('EllisAppsHelpDeskBundle:Ticket');
        $tickets    = $repository->createQueryBuilder('t')
            ->join('EllisAppsHelpDeskBundle:StatusHistory', 'sh', 'WITH', 't.currentStatus = sh')
            ->where('sh.status IN (:status)')
            ->setParameter('status', ['closed', 'complete'])
            ->getQuery()
            ->getResult();

        return $this->render('EllisAppsHelpDeskBundle:Ticket:index.html.twig', [
            'tickets' => $tickets,
        ]);
    }

    /**
     * @Route("/{ticket}/show", name="ellisapps_helpdesk_ticket_show")
     */
    public function showAction(Ticket $ticket, Request $request)
    {
        $statusHistory = new StatusHistory();

        $form = $this->createForm('ellisapps_status_history', $statusHistory);

        $form->handleRequest($request);

        if ($form->isValid()) {
            switch ($form['action']->getData()) {
                case 'note':
                    $statusHistory->setStatus(StatusInterface::CREATED);
                    $statusHistory->setInternal(true);
                    continue;

                case 'reply':
                    $statusHistory->setStatus(StatusInterface::CREATED);
                    break;

                case 'fixed':
                    $statusHistory->setStatus(StatusInterface::FIXED);
                    break;
            }

            $this->changeStatus($ticket, $statusHistory, true);

            $this->addFlash('success', 'Status changed');
            return $this->redirectToRoute('ellisapps_helpdesk_ticket_show', [
                'ticket' => $ticket->getId(),
            ]);
        }

        return $this->render('EllisAppsHelpDeskBundle:Ticket:show.html.twig', [
            'ticket' => $ticket,
            'form'   => $form->createView(),
        ]);
    }

    /**
     * @Route("/add", name="ellisapps_helpdesk_ticket_add")
     */
    public function addAction(Request $request)
    {
        $ticket = new Ticket();

        $form = $this->createForm('ellisapps_ticket', $ticket);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ticket);
            $em->flush();

            /* status history */
            $statusHistory = new StatusHistory();
            $statusHistory->setStatus(StatusInterface::CREATED);
            $statusHistory->setMessage(ucwords($ticket->getPersonName()).' created a ticket.');
            $this->changeStatus($ticket, $statusHistory);

            $this->addFlash('success', 'Ticket created');
            return $this->redirectToRoute('ellisapps_helpdesk_ticket_index');
        }

        return $this->render('EllisAppsHelpDeskBundle:Ticket:addEdit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{ticket}/{status}/add-status", name="ellisapps_helpdesk_ticket_status_add")
     */
    public function addStatusAction(Ticket $ticket, $status)
    {
        $statusHistory = new StatusHistory();

        switch ($status) {
            case 'no-issue':
                $statusHistory->setStatus(StatusInterface::NOISSUE);
                $statusHistory->setMessage('No Issue Found');
                break;

            case 'review':
                $statusHistory->setStatus(StatusInterface::INREVIEW);
                $statusHistory->setMessage('Admin moved to In Review');
                break;

            case 'close':
                $statusHistory->setStatus(StatusInterface::CLOSED);
                $statusHistory->setMessage('Issue was closed');
                break;

            case 'complete':
                $statusHistory->setStatus(StatusInterface::COMPLETE);
                $statusHistory->setMessage('Issue resolved');
                break;
        }

        $this->changeStatus($ticket, $statusHistory, true);

        $this->addFlash('success', 'Status changed');
        return $this->redirectToRoute('ellisapps_helpdesk_ticket_show', [
            'ticket' => $ticket->getId(),
        ]);
    }


    private function changeStatus(Ticket $ticket, StatusHistory $statusHistory, $admin = false)
    {
        /* add to status history */
        $statusHistory->setTicket($ticket);
        $statusHistory->setStatusDate(new \DateTime('now'));

        if ($admin === true) {
            $statusHistory->setPersonName('Admin');
            $statusHistory->setPersonEmail('mellis0292@gmail.com');
        } else {
            $statusHistory->setPersonName($ticket->getPersonName());
            $statusHistory->setPersonEmail($ticket->getPersonEmail());
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($statusHistory);
        $em->flush();

        /* set this status to the new current */
        $ticket->setCurrentStatus($statusHistory);
        $em->flush();
    }
}
