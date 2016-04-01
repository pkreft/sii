<?php

namespace Fixture\Doctrine\Orm;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use NewsBundle\Factory\NewsFactory;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use NewsBundle\Helper\StringHelper;

/**
 * Class LoadNewsData
 * @package Fixture\Doctrine\Orm
 */
class LoadNewsData implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param ObjectManager $objectManager
     */
    public function load(ObjectManager $objectManager)
    {
        foreach ($this->getItems() as $values) {
            $news = NewsFactory::create();

            foreach ( $values as $key => $value ) {
                $method = 'set' . ucfirst(StringHelper::camelize($key));
                $news->$method($value);
            }
            $objectManager->persist($news);
        }
        $objectManager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }

    /**
     * @return array
     */
    private function getItems()
    {
        return array(
            array(
                'preview'   => 'Szejnfeld: Kaczyński realizuje swój scenariusz. Czarnecki: to początek dialogu',
                'content'   => 'Szejnfeld: Kaczyński realizuje swój scenariusz. Czarnecki: to początek dialogu dalsza treść(...)',
                'important' => true
            ), array(
                'preview'   => '"US Weekly": to z nią spotyka się Władimir Putin',
                'content'   => '"US Weekly": to z nią spotyka się Władimir Putin dalsza treść(...)',
                'important' => false
            ), array(
                'preview'   => '"Kicker": "Lewy" jeszcze nie zdecydował. "Trudne negocjacje w sprawie kontraktu"',
                'content'   => '"Kicker": "Lewy" jeszcze nie zdecydował. "Trudne negocjacje w sprawie kontraktu" dalsza treść(...)',
                'important' => false
            ), array(
                'preview'   => 'Kulisy spotkania liderów partyjnych. "Proponowano jakieś ponadpartyjne celebracje"',
                'content'   => 'Kulisy spotkania liderów partyjnych. "Proponowano jakieś ponadpartyjne celebracje" dalsza treść(...)',
                'important' => true
            ), array(
                'preview'   => 'Sejm za nabywaniem ziemi przez Kościół',
                'content'   => 'Sejm za nabywaniem ziemi przez Kościół dalsza treść(...)',
                'important' => true
            ), array(
                'preview'   => 'Bodnar szybszy od mistrza świata. Decydowały ułamki sekundy',
                'content'   => 'Bodnar szybszy od mistrza świata. Decydowały ułamki sekundy dalsza treść(...)',
                'important' => true
            ), array(
                'preview'   => 'Pikniki, tłumy ludzi i piękne kwiaty. Tak zakwitły japońskie wiśnie',
                'content'   => 'Pikniki, tłumy ludzi i piękne kwiaty. Tak zakwitły japońskie wiśnie dalsza treść(...)',
                'important' => false
            ), array(
                'preview'   => 'Warszawa: będzie remont wejść do metra',
                'content'   => 'Warszawa: będzie remont wejść do metra dalsza treść(...)',
                'important' => false
            ), array(
                'preview'   => 'Były prezes TK krytykuje pomysł PO. "To nie jest dobra droga"',
                'content'   => 'Były prezes TK krytykuje pomysł PO. "To nie jest dobra droga" dalsza treść(...)',
                'important' => true
            ), array(
                'preview'   => 'Tanie materiały, omijanie przepisów, budowa od siedmiu lat. Zginęło 21 osób',
                'content'   => 'Tanie materiały, omijanie przepisów, budowa od siedmiu lat. Zginęło 21 osób dalsza treść(...)',
                'important' => false
            )
        );
    }
}
