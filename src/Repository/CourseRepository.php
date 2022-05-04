<?php

namespace App\Repository;

use App\Entity\Course;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Course|null find($id, $lockMode = null, $lockVersion = null)
 * @method Course|null findOneBy(array $criteria, array $orderBy = null)
 * @method Course[]    findAll()
 * @method Course[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Course::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Course $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Course $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findAll(): array {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\Course c
            '
        );
        
        return $query->getResult();
    }

    public function findAllForTests(): array {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\Course c
            '
        );
        
        return $query->getResult(Query::HYDRATE_ARRAY);
    }

    public function findAllLessonsByCourseId(int $id) {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c, l
            FROM App\Entity\Course c
            INNER JOIN c.lessons l
            WHERE c.id = :id
            '
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findAllLessonsByCourseIdForTest(int $id) {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c, l
            FROM App\Entity\Course c
            INNER JOIN c.lessons l
            WHERE c.id = :id
            '
        )->setParameter('id', $id);

        return $query->getOneOrNullResult(Query::HYDRATE_ARRAY);
    }

    public function findById(int $id) {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\Course c
            WHERE c.id = :id
            '
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function deleteCourseWithLessonsById(int $id) {
        $entityManager = $this->getEntityManager();

        $courseDeleteQuery = $entityManager->createQuery(
            'DELETE
            FROM App\Entity\Course c
            WHERE c.id = :id
            '
        )->setParameter('id', $id);

        $lessonsDeleteQuery = $entityManager->createQuery(
            'DELETE
            FROM App\Entity\Lesson l
            WHERE l.course = :id
            '
        )->setParameter('id', $id);

        $lessonsDeleteQuery->execute();
        $courseDeleteQuery->execute();
    }

    // /**
    //  * @return Course[] Returns an array of Course objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Course
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
