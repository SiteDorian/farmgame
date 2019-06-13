<?php

namespace App\Controller;

use App\Entity\Cell;
use App\Entity\Plant;
use App\Entity\User;
use App\Entity\Land;
use App\Entity\Deposit;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\DateTime;


class GameController extends Controller
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
        $plants = $this->getDoctrine()->getRepository(Plant::class)->findAll();

        $userManager = $this->get('fos_user.user_manager');
        $user = $this->getUser();

        $land = $this->getDoctrine()->getRepository(Land::class)->findOneBy(['user' => $user]);

        $cells_land = $this->getDoctrine()->getRepository(Cell::class)->findBy(['land' => $land]);

        $deposit = $this->getDoctrine()->getRepository(Deposit::class)->findBy(['user' => $user]);

        return $this->render('game/index.html.twig', [
            'cells' => $cells_land,
            'plants' => $plants,
            'now' => $now,
            'user' => $user,
            'money' => $user->getMoney(),
            'water' => $user->getWater(),
            'deposit' => $deposit,
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
        $userManager = $this->get('fos_user.user_manager');
        $user = $this->getUser();
        switch((string) $cell->getStage()) {
            case '0': 
                $cell->setStage($cell->getStage()+1);
            $em->flush();
            break;
            
            case '2':
            case '3':
                if($user->getWater() > 0) {
                    $user->setWater( $user->getWater() - 1 );
                    $cell->setStage($cell->getStage()+1);
                    $em->flush();
                }
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
        $userManager = $this->get('fos_user.user_manager');
        $user = $this->getUser();
        $user->setMoney( $user->getMoney() - $plant->getPrice_buy() );
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
        $userManager = $this->get('fos_user.user_manager');
        $user = $this->getUser();
        if ($cell->getStage() == 5) {
            $cell->setStage(0);
            $plant = $cell->getPlant();
            $deposit = $this->getDoctrine()->getRepository(Deposit::class)->findOneBy([
                'user' => $user,
                'plant' => $plant
            ]);
            $deposit->setCount( $deposit->getCount() + 1 );
            $cell->setPlant(null);
            $em->flush();
        }

        return $this->redirectToRoute('game');
    }

    /**
     * @Route("/game/water/{nr}", name="game.water")
     * 
     * @param int $nr
     * @param EntityManagerInterface $em
     * 
     * @return RedirectResponse
     */
    public function water(int $nr=1, EntityManagerInterface $em) : Response
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $this->getUser();
        if($nr>0 and $user->getMoney() >= $nr * 5 ) {
            $user->setMoney($user->getMoney() - $nr * 5);
            $user->setWater($user->getWater() + $nr);
            $em->flush();
        }
        return $this->redirectToRoute('game');
    }

    /**
     * @Route("/game/sell_all", name="game.sell_all")
     * @param EntityManagerInterface $em
     * @return RedirectResponse
     */
    public function sell_all(EntityManagerInterface $em) : Response
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $this->getUser();
        $deposit = $this->getDoctrine()->getRepository(Deposit::class)->findBy([
            'user' => $user
        ]);
        foreach ($deposit as $dep) {
            $user->setMoney($user->getMoney() + $dep->getCount() * $dep->getPlant()->getPrice_sell()  );
            $dep->setCount(0);
        }
        $em->flush();

        return $this->redirectToRoute('game');
    }
}
