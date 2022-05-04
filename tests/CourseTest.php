<?php

namespace App\Tests;

use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;

class CourseTest extends WebTestCase
{
    public function getNumerics ($str) {
        preg_match_all('/\d+/', $str, $matches);
        return $matches[0];
    }

    public function testSomething(): void
    {
        //TODO get number of rows from db for assertCount
        //TODO wrap form test in one function
        echo "\nТест контроллера Course\n";
        echo "Тест страницы курсов\n";
        
        $client = static::createClient();
        $courseRepository = static::getContainer()->get(CourseRepository::class);
        $coursesFromTestDB = $courseRepository->findAllForTests();
        
        $crawler = $client->request('GET', 'http://127.0.0.1:81/courses');
        $this->assertResponseIsSuccessful();

        $courseCountOnSite = $crawler->filter('div.card')->each(function (Crawler $node, $i) {
            return $node->text();
        });
        $this->assertCount(count($coursesFromTestDB), $courseCountOnSite);

        echo "Тест страницы курса\n";

        $crawler = $client->request('GET', 'http://127.0.0.1:81/courses/'.$coursesFromTestDB[0]["id"]);
        $this->assertResponseIsSuccessful();
        $lessonsOfCourseFromDB = $courseRepository->findAllLessonsByCourseIdForTest($coursesFromTestDB[0]["id"]);
        $lessonsOnCoursePage = $crawler->filter('li.list-group-item')->each(function (Crawler $node, $i) {
            return $node->text();
        });
        $this->assertCount(count($lessonsOfCourseFromDB["lessons"]), $lessonsOnCoursePage);

        echo "Тест создания нового курса\n";
        $crawler = $client->request('GET', 'http://127.0.0.1:81/courses/new');
        $this->assertResponseIsSuccessful();
        $buttonCrawlerNode = $crawler->selectButton('Создать'); 
        $form = $buttonCrawlerNode->form();
        $form['course[symbolic_code]'] = '99Z';
        $form['course[title]'] = 'Тест';
        $form['course[description]'] = 'Тест';
        $client->submit($form);
        $crawler = $client->followRedirect();

        $crawler = $client->request('GET', 'http://127.0.0.1:81/courses');
        $courseCountOnSiteAfterAdding = $crawler->filter('div.card')->each(function (Crawler $node, $i) {
            return $node->text();
        });
        $this->assertCount(count($coursesFromTestDB) + 1, $courseCountOnSiteAfterAdding);

        $links= $crawler->filter('a')->each(function (Crawler $node, $i) {
            return $node->attr('href');
        });
        
        echo "Тест редактирования нового курса\n";
        $crawler = $client->request('GET', 'http://127.0.0.1:81'.$links[count($links) - 2] .'/edit');
        $this->assertResponseIsSuccessful();
        $buttonCrawlerNode = $crawler->selectButton('Update');
        $form = $buttonCrawlerNode->form();
        $form['course[symbolic_code]'] = '99X';
        $form['course[title]'] = 'Тест1';
        $form['course[description]'] = 'Тест1';
        $client->submit($form);
        $crawler = $client->followRedirect();

        echo "Тест удаления курса\n";
        $newCourseId = $this->getNumerics($links[count($links) - 2]);
        $crawler = $client->request('GET', 'http://127.0.0.1:81/courses/delete/'.$newCourseId[0]);
        $crawler = $client->followRedirect();
    }
}
