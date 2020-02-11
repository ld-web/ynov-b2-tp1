<?php

namespace App\DataFixtures;

use App\Entity\CardTemplate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
  public function load(ObjectManager $manager)
  {
    $faker = Factory::create();

    for ($i = 0; $i < 20; $i++) {
      $cardTemplate = new CardTemplate();

      $cardTemplate->setName($faker->sentence(3, true))
        ->setDescription($faker->paragraph(5))
        ->setActive($faker->boolean(20))
        ->setPremium($faker->boolean(40))
        ->setPreview('https://source.unsplash.com/random/200x200');

      $manager->persist($cardTemplate);
    }

    $manager->flush();
  }
}
