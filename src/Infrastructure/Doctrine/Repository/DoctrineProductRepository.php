<?php


namespace App\Infrastructure\Doctrine\Repository;


use App\Domain\Product\Product;
use App\Domain\Product\Repository\ProductRepository;
use App\Domain\Product\ValueObject\ProductId;
use Doctrine\ORM\EntityManager;
use Lib\Domain\Aggregate;

class DoctrineProductRepository implements ProductRepository
{
    const ENTITY_CLASS="App\Domain\Product\Product";

    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findOneById(ProductId $productId): ?Product
    {
        $q = $this->entityManager->createQueryBuilder()
            ->select('p')
            ->from(self::ENTITY_CLASS, 'p')
            ->where("p.id = :identity")
            ->setParameter("identity", (string)$productId->getId());

        return $q->getQuery()->getOneOrNullResult();
    }

    public function save(Aggregate $product): void
    {
        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }
}