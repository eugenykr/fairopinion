<?php

namespace FOP\ReviewsBundle\Entity\Repository;

/**
 * OrganizationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OrganizationRepository extends \Doctrine\ORM\EntityRepository
{
	public function getLatestOrganizations($limit = null)
	{
		$qb = $this->createQueryBuilder('o')
			->select('o')
			->addOrderBy('o.created', 'DESC');

		if (false === is_null($limit))
			$qb->setMaxResults($limit);

		return $qb->getQuery()
		          ->getResult();
	}
}