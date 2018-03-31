<?php

namespace FOP\ReviewsBundle\Controller;

use FOP\ReviewsBundle\Entity\Organization;
use FOP\ReviewsBundle\FOPReviewsBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOP\ReviewsBundle\Entity\Review;
use FOP\ReviewsBundle\Form\ReviewType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Review controller
 */
class ReviewController extends Controller
{
	public function newAction($orgId)
	{
		$org = $this->getOrganization($orgId);

		$review = new Review();
		$review->setOrganization($org);
		$form = $this->createForm(ReviewType::class, $review);

		return $this->render('@FOPReviews/Review/form.html.twig', array(
			'review' => $review,
			'form' => $form->createView()
		));
	}

	public function createAction(Request $request, $orgId)
	{
		$org = $this->getOrganization($orgId);

		$review = new Review();
		$review->setOrganization($org);
		$form = $this->createForm(ReviewType::class, $review);
		$form->handleRequest($request);

		if ($form->isValid()){

			return $this->redirect( $this->generateUrl('FOPReviewsBundle:Review:create', array( 'id' => $review->getOrganization()->getId() ) .'#review-'. $review->getId() ));
			}

	}

	protected function getOrganization($orgId)
	{
		$em = $this->getDoctrine()->getManager();

		$org = $em->getRepository('FOPReviewsBundle:Organization')->find($orgId);

		if(!$org) {
			throw $this->createNotFoundException('Организация не найдена');
		}

		return $org;
	}
}