<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\GiftService;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $manager,
        private readonly UserRepository         $userRepository,
        private readonly LoggerInterface        $logger
    )
    {
    }

    #[Route('/default', name: 'app_default')]
    public function index(GiftService $service, Request $request, SessionInterface $session): Response
    {
        $this->logger->info('Start logger test');

        $this->addFlash('notice', 'Flush message test notice');

        $this->addFlash('warning', 'Flush message test warning');

//        $cookie = new Cookie(
//            'my_cookie',
//            'cookie value',
//            time() + (60 * 60)
//        );

//        $response = new Response();

//        $response->headers->setCookie($cookie);

//        $response->headers->clearCookie('my_cookie');

//        $response->send();

//        exit($request->cookies->get('PHPSESSID'));

//        $session->set('my_session', 'session value');

//        $session->remove('my_session');

//        $session->clear();

//        if ($session->has('my_session')) {
//            exit($session->get('my_session'));
//        }

        $users = $this->userRepository->findAll();

//        dump($users);

        $userOne = $this->userRepository->findOneBy(['name' => 'User-1']);

//        if (!$userOne) {
//            throw $this->createNotFoundException('Not user found for name User-1');
//        }

        if ($userOne) {
            $userOne->setName('New User name');
            $this->manager->flush();
        }

        $userTwo = $this->userRepository->findOneBy(['name' => 'User-2']);

        if ($userTwo) {
            $this->manager->remove($userTwo);
            $this->manager->flush();
        }

        $sql = '
        SELECT * FROM user_table u
        WHERE u.id > :id
        ';

        $sqlResult = $this->manager->getConnection()->prepare($sql)->executeQuery(['id' => 2])->fetchAllAssociative();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
            'userOne' => $userOne,
            'random_gifts' => $service->getGifts(),
        ]);
    }

    #[Route('/default/user/{id}', name: 'default-user')]
    public function getOneUser(Request $request, User $user)
    {
        dd($user);
    }

    #[Route('/default2/{page?}', requirements: ["page" => "\d+"])]
    public function zadrRouteLVL1(): Response
    {
        return new Response('Success!');
    }

    #[Route('/default3/{_locale}/{year}/{slug}/{category}', requirements: ['_locale' => 'en|fr', 'category' => 'computers|rtv', 'year' => '\d+'], defaults: ['category' => 'computers'])]
    public function zadrRouteLVL2(): Response
    {
        return new Response('Success!');
    }

    #[Route(['nl' => '/over-ons', 'en' => '/about-us'])]
    public function zadrRouteLVL3(): Response
    {
        return new Response('Success!');
    }

    public function mostPopularPosts($number = 3): Response
    {
        $posts = array_map(function ($key) {
            return 'post-' . $key + 1;
        }, range(0, $number - 1));

        return $this->render('default/most_popular_posts.html.twig', [
            'posts' => $posts
        ]);
    }
}
