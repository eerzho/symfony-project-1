<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\GiftService;
use App\Services\MyService2;
use App\Services\MyService4;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $manager)
    {
    }

    #[Route('/default', name: 'app_default')]
    public function index(GiftService $service, Request $request, SessionInterface $session, MyService4 $myService4): Response
    {
        $myService4->someAction();
//        $this->logger->info('Start logger test');

//        $this->addFlash('notice', 'Flush message test notice');

//        $this->addFlash('warning', 'Flush message test warning');

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

//        $users = $this->userRepository->findAll();

//        dump($users);

//        $userOne = $this->userRepository->findOneBy(['name' => 'User-1']);

//        if (!$userOne) {
//            throw $this->createNotFoundException('Not user found for name User-1');
//        }

//        if ($userOne) {
//            $userOne->setName('New User name');
//            $this->manager->flush();
//        }

//        $userTwo = $this->userRepository->findOneBy(['name' => 'User-2']);

//        if ($userTwo) {
//            $this->manager->remove($userTwo);
//            $this->manager->flush();
//        }

//        $sql = '
//        SELECT * FROM user_table u
//        WHERE u.id > :id
//        ';

//        $sqlResult = $this->manager->getConnection()->prepare($sql)->executeQuery(['id' => 2])->fetchAllAssociative();

//        $author = new User();
//        $author->setName('Video Author');
//
//        for ($i = 0; $i <= 3; $i++) {
//
//            $video = new Video();
//
//            $video->setTitle('Video title-'.$i);
//
//            $author->addVideo($video);
//
//            $this->manager->persist($video);
//        }
//
//        $this->manager->persist($author);
//
//        $this->manager->flush();
//
//        $removeTest = $this->userRepository->findOneBy(['id' => 4]);
//        $this->manager->remove($removeTest);
//        $this->manager->flush();

//        $user = $this->userRepository->findOneBy(['id' => 3]);
//        $video = $this->videoRepository->findOneBy(['id' => 9]);
//        $user->removeVideo($video);
//        $this->manager->flush();

//        $user1 = $this->userRepository->findOneBy(['id' => 1]);
//        $user2 = $this->userRepository->findOneBy(['id' => 2]);
//        $user3 = $this->userRepository->findOneBy(['id' => 3]);
//        $user4 = $this->userRepository->findOneBy(['id' => 4]);
//
//        $user1->addFollowed($user2);
//        $user1->addFollowed($user3);
//        $user1->addFollowed($user4);

//        $this->manager->flush();

//        dump($user1->getFollowed()->count());
//        dump($user2->getFollowing()->count());

//        $user = new User();
//
//        $user->setName('Robert');
//
//        for ($i = 1; $i <= 3; $i++) {
//            $video = new Video();
//            $video->setTitle('Video title - ' . $i);
//            $user->addVideo($video);
//            $this->manager->persist($video);
//        }
//
//        $this->manager->persist($user);
//        $this->manager->flush();

//        $user = $this->userRepository->findWithVideos(6);

//        $files = $this->manager->getRepository(File::class)->findAll();
//        $pfdFiles = $this->manager->getRepository(Pdf::class)->findAll();
//        $videoFiles = $this->manager->getRepository(Video::class)->findAll();

//        $author = $this->manager->getRepository(Author::class)->findByIdWithPdf(1);
//        dump($author);
//
//        foreach ($author->getFiles() as $file) {
//            if ($file instanceof Pdf) {
//                dump($file->getFilename());
//            }
//        }

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'random_gifts' => $service->getGifts(),
        ]);
    }

    #[Route('/default/user/pre-persist-test', name: 'pre-persist-test')]
    public function prePersistTest()
    {
        $user = new User();
        $user->setName('Pre persist test');
        $this->manager->persist($user);
        $this->manager->flush();

        return $this->json(['message' => 'Success!']);
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
