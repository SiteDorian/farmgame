<?php

namespace App\Controller;

use App\Entity\Cell;
use App\Entity\Plant;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class GameController extends AbstractController
{
    public function __construct()
    {
        date_default_timezone_set("Europe/Chisinau");
    }

    /**
     * @Route("/game", name="game", methods="GET")
     * 
     * @return Response
     */
    public function index(EntityManagerInterface $em)
    {
        // $now = date('H:i', time() );
        $now = new \DateTime("now");
        $cells = $em->getRepository(Cell::class)->findCells();
        $plants = $this->getDoctrine()->getRepository(Plant::class)->findAll();

        return $this->render('game/index.html.twig', [
            'cells' => $cells,
            'plants' => $plants,
            'now' => $now,
        ]);
    }

    /**
     * Finds and modifies the stage of a cell entity.
     * 
     * @Route("/game/click/{id}", name="game.click")
     * 
     * @param Cell $cell
     * @param EntityManagerInterface $em
     * 
     * @return RedirectResponse
     */
    public function click(Cell $cell, EntityManagerInterface $em) : Response
    {
        switch((string) $cell->getStage()) {
            case '0': 
            case '2':
            case '3':
                $cell->setStage($cell->getStage()+1);
            $em->flush();
            break;
        }
        return $this->redirectToRoute('game');
    }

    /**
     * @Route("/game/cultivate/{plant}/{cell}", name="game.cultivate")
     * 
     * @param Plant $plant
     * @param Cell $cell
     * @param EntityManagerInterface $em
     * 
     * @return RedirectResponse
     */
    public function cultivate(Plant $plant, Cell $cell, EntityManagerInterface $em) : Response
    {
        $cell->setStage($cell->getStage()+1);
        $cell->setPlant($plant);
        $em->flush();

        return $this->redirectToRoute('game');
    }

    /**
     * @Route("/game/timer/{id}", name="game.timer")
     * 
     * @param Cell $cell
     * @param EntityManagerInterface $em
     * 
     * @return RedirectResponse
     */
    public function timer(Cell $cell, EntityManagerInterface $em) : Response
    {
        $now = time();

        $cell_date = time($cell->getTime());

        

        if( $cell_date + $cell->getPlant()->getTime() > $now  ) {
            $cell->setStage(5);
            $em->flush();
        }

        return $this->redirectToRoute('game');
    }

    /**
     * @Route("/game/collect/{id}", name="game.collect")
     * 
     * @param Cell $cell
     * @param EntityManagerInterface $em
     * 
     * @return RedirectResponse
     */
    public function collect(Cell $cell, EntityManagerInterface $em) : Response
    {
        if ($cell->getStage() == 5) {
            $cell->setStage(0);
            $cell->setPlant(null);
            $em->flush();
        }

        return $this->redirectToRoute('game');
    }
}
