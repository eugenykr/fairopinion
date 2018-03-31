<?php
namespace FOP\ReviewsBundle\Controller;

use FOP\ReviewsBundle\Entity\Enquiry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request;
use FOP\ReviewsBundle\Form\EnquiryType;

class PageController extends Controller
{
	public function indexAction()
	{
		$em = $this->getDoctrine()
					->getManager();

		$organizations = $em->getRepository('FOPReviewsBundle:Organization')
							->getLatestOrganizations();

		return $this->render('@FOPReviews/Page/index.html.twig', array(
			'organizations' => $organizations,
		));
	}

	public function aboutAction()
	{
		return $this->render('@FOPReviews/Page/about.html.twig');
	}

	public function contactsAction(Request $request)
	{
		$enquiry = new Enquiry();

		$form = $this->createForm(EnquiryType::class, $enquiry);

		if ($request->isMethod($request::METHOD_POST)) {
			$form->handleRequest($request);

				if ($form->isValid()){

					$message = \Swift_Message::newInstance()
						->setSubject('Сообщение с fair-opinion.ru')
						->setFrom('eugenykr@gmail.com')
						->setTo($this->container->getParameter('fop_reviews.emails.contact_email'))
						->setBody($this->renderView('@FOPReviews/Page/contactEmail.txt.twig', array('enquiry' => $enquiry)));

					$this->get('mailer')->send($message);

					$this->get('session')->getFlashBag()->add('reviews-notice', 'Спасибо, ваш запрос успешно отправлен');

					return $this->redirect($this->generateUrl('FOPReviewsBundle_contacts'));
				}
		}

		return $this->render('@FOPReviews/Page/contacts.html.twig', array(
			'form' => $form->createView()
		));
	}
}
