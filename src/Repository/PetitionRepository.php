<?php

namespace App\Repository;

use App\Entity\Petition;
use App\Entity\Signature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Petition>
 *
 * @method Petition|null find($id, $lockMode = null, $lockVersion = null)
 * @method Petition|null findOneBy(array $criteria, array $orderBy = null)
 * @method Petition[]    findAll()
 * @method Petition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PetitionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Petition::class);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function getByPublicId(string $publicId): Petition
    {
        $entity = $this->findOneBy(['public_id' => $publicId]);

        if (!$entity instanceof Petition) {
            throw new EntityNotFoundException("Petition was not fount. public_id is [$publicId]");
        }

        return $entity;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function get(int $id): Petition
    {
        $entity = $this->find($id);

        if (!$entity instanceof Petition) {
            throw new EntityNotFoundException("Petition was not fount [$id]");
        }

        return $entity;
    }

    public function save(Petition $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Petition $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
