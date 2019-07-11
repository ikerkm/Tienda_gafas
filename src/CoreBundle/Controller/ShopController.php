<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Entity\Glasses;
use CoreBundle\Entity\Category;
use CoreBundle\Entity\Sex;

class ShopController extends Controller
{

    /**
     * @Route("/")
     */
    public function showMain()
    {
        $repository_gender = $this->getDoctrine()->getRepository(Sex::class);
        $gender = $repository_gender->findAll();
        $repository_category =  $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository_category->findAll();
        $repository_glasses = $this->getDoctrine()->getRepository(Glasses::class);
        $glasses = $repository_glasses->findAll();
        $user = $this->getUser();
        if ($user) {
            $user_name = $user->getName() . " " . $user->getSurname();
        } else {
            $user_name = "Guest";
        }
        return $this->render('@Core/Default/Shop/home.html.twig', ['user_name' => $user_name, 'glasses' => $glasses, 'categories' => $categories, 'gender' => $gender]);
    }

    /**
     * @Route("/product/{id}", name="product_detail")
     */

    public function showGlass(Request $request)
    {
        $id = $request->attributes->get('id');
        $repository = $this->getDoctrine()->getRepository(Glasses::class);
        $glasses = $repository->findById($id);
        $user = $this->getUser();
        if ($user) {
            $user_name = $user->getName() . " " . $user->getSurname();
        } else {
            $user_name = "Guest";
        }
        return $this->render('@Core/Default/Shop/glass.html.twig', ['glass_desc' => $glasses, 'user_name' => $user_name]);
    }

    /**
     * @Route("/category/{id}", name="product_category")
     */
    public function showCateogry(Request $request)
    {
        $category_id = $request->attributes->get('id');
        dump($category_id);
        $repository_gender = $this->getDoctrine()->getRepository(Sex::class);
        $gender = $repository_gender->findAll();
        $repository_category =  $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository_category->findAll();
        $repository_glasses = $this->getDoctrine()->getRepository(Glasses::class);
        $glasses = $repository_glasses->findByCategory($category_id);
        $user = $this->getUser();
        if ($user) {
            $user_name = $user->getName() . " " . $user->getSurname();
        } else {
            $user_name = "Guest";
        }
        return $this->render('@Core/Default/Shop/category.html.twig', ['user_name' => $user_name, 'glasses' => $glasses, 'categories' => $categories, 'gender' => $gender]);
    }


    /**
     * @Route("/gender/{id}", name="product_gender")
     */
    public function showGender(Request $request)
    {
        $gender_id = $request->attributes->get('id');
        $repository_gender = $this->getDoctrine()->getRepository(Sex::class);
        $gender = $repository_gender->findAll();
        $repository_category =  $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository_category->findAll();
        $repository_glasses = $this->getDoctrine()->getRepository(Glasses::class);
        $glasses = $repository_glasses->findBySex($gender_id);
        $user = $this->getUser();
        if ($user) {
            $user_name = $user->getName() . " " . $user->getSurname();
        } else {
            $user_name = "Guest";
        }
        return $this->render('@Core/Default/Shop/category.html.twig', ['user_name' => $user_name, 'glasses' => $glasses, 'categories' => $categories, 'gender' => $gender]);
    }
}
