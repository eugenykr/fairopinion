<?php

namespace FOP\ReviewsBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ReviewRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReviewRepository extends \Doctrine\ORM\EntityRepository
{
	public function getOrganizationReviews($orgId, $approved = true)
	{
		$qb = $this->createQueryBuilder('r')
					->select('r')
					->where('r.organization = :org_id')
					->addOrderBy('r.created')
					->setParameter(':org_id', $orgId);

		if (false === is_null($approved))
			$qb->andWhere('r.approved = :approved')
				->setParameter(':approved', $approved);

		return $qb->getQuery()->getResult();
	}
}