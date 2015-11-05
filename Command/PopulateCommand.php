<?php

namespace Interne\SeanceBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Interne\SeanceBundle\Entity\Container;
use Interne\SeanceBundle\Entity\Meeting;
use Interne\SeanceBundle\Entity\Item;
use Interne\SeanceBundle\Entity\Tag;

use Faker\Factory as Fixture;


class PopulateCommand extends ContainerAwareCommand
{
    private $nbContainers = 4;
    private $minNbMeetings = 5;
    private $maxNbMeetings = 10;
    private $minNbItems = 3;
    private $maxNbItems = 8;
    private $tags = [];

    protected function configure()
    {
        $this
            ->setName('seance:populate')
            ->setDescription('Remplir les entrées de la base de données pour le SeanceBundle')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $progress    = $this->getHelperSet()->get('progress');

        echo 'Creating a few tags...\n';
        for($i = 1; $i < 6; $i++) {
            $tag = $this->createTag();
            $em->persist($tag);
        }
        echo 'Done!\n\n';

        echo 'Will now create a few meetings...\n';
        $progress->start($output, $this->nbContainers);

        for ($i=1; $i <= $this->nbContainers; $i++) {
            // Create a container
            $container = $this->createContainer();
            $em->persist($container);


            // Create the related meetings
            $meetings_to_create = rand($this->minNbMeetings, $this->maxNbMeetings);
            for($j = 0; $j < $meetings_to_create; $j++) {
                $meeting = $this->createMeeting();
                $container->addMeeting($meeting);
                $meeting->setContainer($container);

                // Create the related items
                $items_to_create = rand($this->minNbItems, $this->maxNbItems);
                for($k = 0; $k < $items_to_create; $k++) {
                    $item = $this->createItem();
                    $meeting->addItem($item);
                    $item->setMeeting($meeting);

                    $this->attachRandomTags($item);

                    $em->persist($item);
                }

                $em->persist($meeting);
            }

            $progress->advance();   
        }
        $progress->finish();

        echo 'Populating database...\n';
        $em->flush();
        echo 'Done !\n';

    }



    /**********************************************************************
                             HELPER CREATION METHODS
     **********************************************************************/
    private function createContainer() {
        $container = new Container();

        $container->setDescription($this->getSentence());
        $container->setTitle($this->getTitle());

        return $container;
    }

    private function createMeeting() {
        $meeting = new Meeting();

        $meeting->setName($this->getTitle(true));
        $meeting->setDate($this->getDate());
        $meeting->setPlace($this->getLocation());

        return $meeting;
    }

    private function createItem() {
        $item = new Item();

        $item->setTitle($this->getTitle());
        $item->setDescription($this->getHtmlDescription());

        return $item;
    }

    private function createTag() {
        $tag = new Tag();

        $tag->setTitle($this->getTitle());
        $tag->setDescription($this->getSentence());
        $tag->setDisplayHome($this->getBoolean());
        $tag->setIsTrackable($this->getBoolean());
        $tag->setMoveToStack($this->getBoolean());

        return $tag;
    }

    private function attachRandomTags(Item $item) {
        $tags_copy = $this->tags;
        $tags_to_attach = rand(0, sizeof($this->tags));

        for($i = 0; $i < $tags_to_attach; $i++) {
            $index = rand(0, sizeof($tags_copy) - 1);
            $item->addTag($tags_copy[$index]);
            array_splice($tags_copy, $index, 1);
        }
    }

    /**********************************************************************
                             HELPER GENERTOR METHODS
     **********************************************************************/

    private function getContainerName() {
        return ucfirst(implode(' ', Fixture::create("fr_FR")->words(2)));
    }

    private function getTitle($isMeeting = false) {
        $debut = ["Réunion", "Séance", "Maîtrise"];

        $prefix = ($isMeeting)? $debut[rand(0, count($debut) - 1)] . ' ' : "";
        return $prefix . implode(' ', Fixture::create("fr_FR")->words(2));
    }

    private function getHtmlDescription() {
        return '<p>' . implode('</p><p>', Fixture::create("fr_FR")->paragraphs(rand(1, 4))) . '</p>';
    }

    private function getSentence() {
        return Fixture::create("fr_FR")->sentence(7);
    }

    private function getLocation() {
        return Fixture::create("fr_FR")->city;
    }

    private function getDate() {
        return Fixture::create("fr_FR")->dateTimeThisDecade('+ 2 years');
    }

    private function getBoolean() {
        return rand(0, 1) == true;
    }

}