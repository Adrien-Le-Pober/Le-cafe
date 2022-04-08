<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(SessionInterface $session, ProductRepository $productRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $cart = $session->get("cart", []);

        $data = [];
        $total = 0;

        foreach($cart as $id => $quantity) {
            $product = $productRepository->find($id);
            $data[] = [
                "product" => $product,
                "quantity" => $quantity,
                "subtotal" => $product->getPrice() * $quantity
            ];
            $total += $product->getPrice() * $quantity;
        }

        return $this->render("cart/index.html.twig", compact
        ("data", "total"));
    }

    #[Route('/add/{id}', name: 'app_cart_add')]
    public function add(Product $product, SessionInterface $session)
    {
        $cart = $session->get("cart", []);
        $id = $product->getId();

        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }
        //sauvegarde de la session
        $session->set("cart", $cart);

        return $this->redirectToRoute("app_cart");
    }

    #[Route("/remove/{id}", name: 'app_cart_remove')]
    public function remove(Product $product, SessionInterface $session)
    {
        $cart = $session->get("cart", []);
        $id = $product->getId();

        if (!empty($cart[$id])) {
            if ($cart[$id] > 1) {
                $cart[$id]--;
            } else {
                unset($cart[$id]);
            }
        }
        //sauvegarde de la session
        $session->set("cart", $cart);

        return $this->redirectToRoute("app_cart");
    }

    #[Route("/delete/{id}", name: 'app_cart_delete')]
    public function delete(Product $product, SessionInterface $session)
    {
        $cart = $session->get("cart", []);
        $id = $product->getId();

        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }
        //sauvegarde de la session
        $session->set("cart", $cart);

        return $this->redirectToRoute("app_cart");
    }
}
