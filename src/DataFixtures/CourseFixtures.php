<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Entity\Lesson;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class CourseFixtures extends Fixture {
    public function load(ObjectManager $manager)
    {
        # fixture for 1st course with lessons
        $course1 = new Course();
        $course1->setCharacterCode("01A");
        $course1->setTitle("Курс алгебры");
        $course1->setDescription("Курс для обучения алгебры");

        $lesson11 = new Lesson();
        $lesson11->setCourse($course1);
        $lesson11->setTitle("Показательная функция, ее свойства и график. Начальные сведения");
        $lesson11->setLessonContent("Данный урок посвящен показательной функции. Мы введем определение, покажем необходимость и актуальность данной функции. Далее охарактеризуем ее свойства и поведение в общем и частных случаях, построим графики и сравним их.");
        $lesson11->setSerialNumber(1);

        $lesson12 = new Lesson();
        $lesson12->setCourse($course1);
        $lesson12->setTitle("Тригонометрические уравнения, вычисления");
        $lesson12->setLessonContent("На этом уроке мы повторим тригонометрические уравнения и вычисления.
        В начале урока мы вспомним определения прямой и обратной задачи для некоторой функции и повторим определения основных тригонометрических функций. Решим несколько простейших тригонометрических уравнений и более сложное уравнение с использованием замены переменной.
        В конце урока мы вспомним формулы двойного и половинного аргумента, а также формулу универсальной тригонометрической подстановки и решим обобщенную задачу на эту тему.
        ");
        $lesson12->setSerialNumber(2);

        $lesson13 = new Lesson();
        $lesson13->setCourse($course1);
        $lesson13->setTitle("Производная функции. Профильный уровень");
        $lesson13->setLessonContent("Современная медицина находится на высоком уровне развития. Сейчас возможно определить не только болен человек или здоров, но и динамику течения его болезни: идёт он на поправку или же его состояние ухудшается. В этом заключается существенное отличие. Если знать состояние пациента, то можно лишь сказать, нуждается ли он в лечении или нет. А если знать, как изменяется его состояние, то можно сказать больше: правильно ли подобрано лечение, через какое время пациент выздоровеет; или наоборот: сколько осталось времени, пока состояние не стало критическим.");
        $lesson13->setSerialNumber(3);
        

        # fixture for 2nd course with lessons     
        $course2 = new Course();
        $course2->setCharacterCode("01B");
        $course2->setTitle("Курс программирования");
        $course2->setDescription("Курс для обучения программирования на языке Python");

        $lesson21 = new Lesson();
        $lesson21->setCourse($course2);
        $lesson21->setTitle("Общая информация о курсе");
        $lesson21->setLessonContent("Данный урок предоставляет информацию о курсе, какиец цели ставили перед собой его создатели, какие навыки получат прошедшие курс люди");
        $lesson21->setSerialNumber(1);

        $lesson22 = new Lesson();
        $lesson22->setCourse($course2);
        $lesson22->setTitle("Введение: программы и Python. Проверка заданий");
        $lesson22->setLessonContent("Какое место занимает Python в современном мире? Пример самых популярных программ на этом языке, сфера его применения.");
        $lesson22->setSerialNumber(2);

        $lesson23 = new Lesson();
        $lesson23->setCourse($course2);
        $lesson23->setTitle("Интерактивный режим Python. IPython");
        $lesson23->setLessonContent("Познакомимся с интерактивных режимом Python, узнаем какие возможности предоставляет этот режим разработчику. Итак, чтобы войти в интерактивный режим Python...");
        $lesson23->setSerialNumber(3);

        $lesson24 = new Lesson();
        $lesson24->setCourse($course2);
        $lesson24->setTitle("Операции с целыми числами");
        $lesson24->setLessonContent("Операции с целыми числами в Python проводятся с операторами + и -, умножение и деление приводит числа в тип с плавающей точкой...");
        $lesson24->setSerialNumber(4);


        # fixture for 3rd course with lessons
        $course3 = new Course();
        $course3->setCharacterCode("01C");
        $course3->setTitle("Курс веб дизайна");
        $course3->setDescription("Курс для обучения веб дизайна");

        $lesson31 = new Lesson();
        $lesson31->setCourse($course3);
        $lesson31->setTitle("figma");
        $lesson31->setLessonContent("научитесь использовать главный инструмент для работы с интерфейсами. узнаете как проектировать структуру сайтов, создавать прототипы страниц и работать над улучшением ux");
        $lesson31->setSerialNumber(1);

        $lesson32 = new Lesson();
        $lesson32->setCourse($course3);
        $lesson32->setTitle("основы дизайна");
        $lesson32->setLessonContent("познакомитесь с ключевыми понятиями и принципами дизайна, лежащими в основе любого изображения и макета. выполните практические задания по разработке сайтов и рекламной графики для закрепления материала");
        $lesson32->setSerialNumber(2);

        $lesson33 = new Lesson();
        $lesson33->setCourse($course3);
        $lesson33->setTitle("blender");
        $lesson33->setLessonContent("освоите навыки работы с 3d, научитесь быстро подбирать референсы и уже готовые модели, чтобы добавлять эффектную графику на сайты");
        $lesson33->setSerialNumber(3);


        # fixture for 4th course with lessons 
        $course4 = new Course();
        $course4->setCharacterCode("01D");
        $course4->setTitle("Курс SMM");
        $course4->setDescription("Курс для обучения SMM");

        $lesson41 = new Lesson();
        $lesson41->setCourse($course4);
        $lesson41->setTitle("Зачем нужен SMM");
        $lesson41->setLessonContent("Познакомитесь с популярными социальными сетями в России и поймёте их алгоритмы работы. Изучите роли и задачи SMM в бизнесе и узнаете, какие навыки должны быть у SMM-менеджера.");
        $lesson41->setSerialNumber(1);

        $lesson42 = new Lesson();
        $lesson42->setCourse($course4);
        $lesson42->setTitle("Погружаемся в стратегию");
        $lesson42->setLessonContent("Поймёте роль SMM-стратегии в бизнесе. Научитесь брифовать заказчиков, анализировать конкурентов и целевую аудиторию, составлять портреты целевой аудитории и говорить с ней на одном языке. Разберётесь, что такое KPI и как их правильно определять. Сможете решать тактические задачи бренда.");
        $lesson42->setSerialNumber(2);

        $lesson43 = new Lesson();
        $lesson43->setCourse($course4);
        $lesson43->setTitle("Контент для социальных сетей");
        $lesson43->setLessonContent("Познакомитесь с основными типами контента и поймёте их роль в маркетинге. Узнаете, как формировать tone of voice. Научитесь искать темы для постов, составлять рубрикатор и контент-план.");
        $lesson43->setSerialNumber(3);

        //$manager->persist($product);

        $manager->persist($course1);
        $manager->persist($lesson11);
        $manager->persist($lesson12);
        $manager->persist($lesson13);
        
        $manager->persist($course2);
        $manager->persist($lesson21);
        $manager->persist($lesson22);
        $manager->persist($lesson23);
        $manager->persist($lesson24);

        $manager->persist($course3);
        $manager->persist($lesson31);
        $manager->persist($lesson32);
        $manager->persist($lesson33);

        $manager->persist($course4);
        $manager->persist($lesson41);
        $manager->persist($lesson42);
        $manager->persist($lesson43);

        $manager->flush();
    }
}