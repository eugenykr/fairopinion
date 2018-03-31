<?php

namespace FOP\ReviewsBundle\Controller;

use FOP\ReviewsBundle\Entity\Organization;
use FOP\ReviewsBundle\FOPReviewsBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class BlogController
 * @package FOP\ReviewsBundle\Controller
 */
class OrganizationController extends Controller
{
	/**
	 * Show an organization entry
	 * @param $id
	 */
	public function showAction($id)
	{
		$em = $this->getDoctrine()->getManager();

		$organization = $em->getRepository('FOPReviewsBundle:Organization')->find($id);

		if (!$organization) {
			throw $this->createNotFoundException('Организация не найдена');
		}

		$reviews = $em->getRepository('FOPReviewsBundle:Review')
						->getOrganizationReviews($organization->getId());

		return $this->render('@FOPReviews/Organization/show.html.twig', array(
			'organization' => $organization,
			'reviews' => $reviews
		));
	}
}