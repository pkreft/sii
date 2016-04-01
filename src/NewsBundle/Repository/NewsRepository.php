<?php

namespace NewsBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class NewsRepository
 * @package NewsBundle\Repository
 */
class NewsRepository extends EntityRepository
{
    /**
     * @param \DateTime|null $lastDateTime
     * @return array
     */
    public function findNews($lastDateTime = null)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('n')
            ->from('NewsBundle\Entity\News', 'n')
            ->orderBy('n.createDateTime', 'desc')
            ->setMaxResults(10);

        if ( $lastDateTime !== null ) {
            $qb->andWhere($qb->expr()->gte('n.createDateTime',':lastDateTime'))
                ->setParameter('lastDateTime', $lastDateTime);
        }
        $result = $qb->getQuery()->getResult();

        return $result;
    }
}
