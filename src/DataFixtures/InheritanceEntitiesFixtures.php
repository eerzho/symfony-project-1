<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Pdf;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class InheritanceEntitiesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 2; $i++) {
            $author = new Author();
            $author->setName('author name - ' . $i);
            $manager->persist($author);

            for ($j = 1; $j <= 3; $j++) {
                $pdf = new Pdf();
                $pdf->setFilename('pdf name of user - ' . $i)
                    ->setDescription('pdf description of user - ' . $i)
                    ->setSize(5454)
                    ->setOrientation('portrait')
                    ->setPagesNumber(123)
                    ->setAuthor($author);
                $manager->persist($pdf);
            }

            for ($j = 1; $j <= 3; $j++) {
                $video = new Video();
                $video->setFilename('video name of user - ' . $i)
                    ->setDescription('video description of user - ' . $i)
                    ->setSize(5050)
                    ->setFormat('mpeg-2')
                    ->setDuration(321)
                    ->setAuthor($author);
                $manager->persist($video);
            }
        }

        $manager->flush();
    }
}
